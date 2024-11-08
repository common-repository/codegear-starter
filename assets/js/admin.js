window.plugin = window.plugin || {};


(function(){
	'use strict';

    async function fetchImportTheme(demo_id) {
        const data = new FormData();
        data.append('action', 'codegear_import_theme');
        data.append('nonce', starter_localize.nonce);
        data.append('demo_id', demo_id);

        try {
            const response = await fetch(starter_localize.ajax_url, {
                method: 'POST',
                credentials: 'same-origin',
                body: data
            });

            const json = await response.json();
            return json.data;
        } catch (error) {
            throw new Error(starter_localize.failed_message);
        }
    }

	async function importDemo(demo_id) {
        const output = document.getElementById('block-import-output');
        try {
            document.body.classList.add('js-import-theme-active');
            output.classList.add('block-import-load');

            const data = await fetchImportTheme(demo_id);

            output.classList.remove('block-import-load');
            if (data) {
                output.innerHTML = data;
            }

            if (data.success) {
                document.querySelector('.starter-demo-import-close').addEventListener('click', (event) => {
                    event.preventDefault();
                    document.body.classList.remove('js-import-theme-active');
                    output.innerHTML = '';
                });
            }
        } catch (error) {
            output.innerHTML = '<span>' + error.message + '</span>';
        }
    }

	async function startImport(step = 0) {
        const formElements = document.querySelectorAll('.block--form-step');
        const formElement = formElements[step];
        const formLength = formElements.length;

        if (step >= formLength) {
            setTimeout(function() {
                document.querySelector('.block-import-process').classList.remove('block-import-active');
                document.querySelector('.block--import-finish').classList.add('block-import-active');
            }, 200);
            return;
        }

        const formData = new FormData(formElement);
        for (const [name, value] of formData) {
            if (name === 'step_name') {
                document.querySelector('.block--import-progress-label').innerHTML = value;
                break;
            }
        }

        if (formElement.querySelector('.starter-checkbox').checked) {
            try {
                const response = await fetch(starter_localize.ajax_url, {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    if ('undefined' !== typeof data.status && 'newAJAX' === data.status) {
                        await startImport(step);
                    } else {
                        step = step + 1;
                        if (step <= formLength) {
                            const indicator = Math.floor((100 / formLength) * step);
                            document.querySelector('.block--import-progress-indicator').style.setProperty('--app-progress', indicator + '%');
                            document.querySelector('.block-import-label').innerHTML = indicator + '%';
                        }

                        await startImport(step);
                    }
                } else {
                    const messageOutput = document.getElementById('message_output');
                    if (messageOutput) {
                        messageOutput.innerHTML = '<span>' + starter_localize.failed_message + '</span>';
                    }
                }
            } catch (error) {
                const messageOutput = document.getElementById('message_output');
                if (messageOutput) {
                    messageOutput.innerHTML = '<span>' + starter_localize.failed_message + '</span>';
                }
            }
        } else {
            await startImport(step + 1);
        }
    }

    function starterFilter() {
        const filterSelect = document.querySelector('[data-filter]');
        const starterSelect = document.querySelectorAll('[data-starter-select]');
        const filterSelectItems = filterSelect.querySelectorAll('[data-fiter-selector]');

        filterSelectItems.forEach(element => {
            element.addEventListener('click', ( event ) => {

                event.preventDefault();
                const value = element.dataset.value;

                filterSelectItems.forEach(item => {
                    item.classList.toggle('active', item === element);
                });

                starterSelect.forEach(item => {
                    const itemCat = item.dataset.categories;

                    const shouldBeVisible = value === '' || itemCat.includes(value);
                    item.classList.toggle('hidden', !shouldBeVisible);
                });

            });
        });
    }

    function init() {
        const importButtons = document.querySelectorAll('.button-import');
        importButtons.forEach((item) => {
            item.addEventListener('click', async (event) => {
                event.preventDefault();
                const demo_id = item.dataset.id;
                await importDemo(demo_id);
            });
        });

        document.querySelector('.starter-demo-import-start').addEventListener('click', async (e) => {
            e.preventDefault();
            document.querySelector('.block-import-start').classList.remove('block-import-active');
            document.querySelector('.block-import-process').classList.add('block-import-active');
            document.querySelector('.block-import-label').innerHTML = '0%';
            document.querySelector('.block--import-progress-indicator').style.setProperty('--app-progress', '0%');
            await startImport();
        });


        starterFilter();
    }


	/*============================================================================
    Things that require DOM to be ready
	==============================================================================*/
	function DOMready(callback) {
        if (document.readyState !== 'loading') {
            callback();
        } else {
            document.addEventListener('DOMContentLoaded', callback);
        }
    }

    DOMready(function() {
        init();
    });

})();
