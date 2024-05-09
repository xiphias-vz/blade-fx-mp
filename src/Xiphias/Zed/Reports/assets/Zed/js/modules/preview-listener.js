'use strict';

var reportTab = document.querySelector('#tab-content-report');
var reportBlock = document.querySelector('#reports');
var $previewModal = $('.preview-modal');

function initialize() {
    const listenerAdder = new PreviewListenerAdder();
    listenerAdder.addListenerToReportsTable();
}

function PreviewListenerAdder() {
    function addListenerToReportsTable() {
        setTimeout(() => {
            let tableContainer = getTableContainer();
            var $reportsTable = $(tableContainer.querySelector('table')).DataTable();

            $reportsTable.on('draw', function () {
                let tableRows = tableContainer.querySelectorAll('tr')
                tableRows.forEach((row) => {
                    if (row.classList.contains('odd') || row.classList.contains('even')) {
                        let button = row.querySelector('a.btn-edit');

                        if (!button) {
                            button = row.querySelector('a.btn-preview');
                        }

                        if (button !== null) {
                            button.addEventListener('click', async (e) => {
                                e.preventDefault();

                                const iframeUrl = await getIframeUrl(button.href)
                                $('.modal-body').attr('src', iframeUrl);
                                displayModal();

                            });

                            row.addEventListener('dblclick', async () => {
                                const iframeUrl = await getIframeUrl(button.href)
                                $('.modal-body').attr('src', iframeUrl);
                                displayModal();
                            });
                        }
                    }
                });
            });
        }, 10);
    }

    async function getIframeUrl(url) {
        const response = await fetch(url)
        const responseJson = await response.json()

        return responseJson.iframeUrl
    }

    function displayModal() {
        $previewModal.modal('show');
    }

    function getTableContainer() {
        let tableContainer;
        if (reportTab) {
            return reportTab.querySelector('div.dataTables_scrollBody')
        }

        if (reportBlock) {
            return reportBlock.querySelector('div.dataTables_scrollBody')
        }

        return document.querySelector('div.dataTables_scrollBody')
    }

    return {
        addListenerToReportsTable: addListenerToReportsTable,
    }
}

module.exports = {
    initialize: initialize,
}
