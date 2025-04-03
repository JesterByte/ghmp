function createDataTable(tableId, exportName, pricingTable = false) {
    exportedColumns = pricingTable == true ? ':visible' : ':not(:last-child)';

    new DataTable(tableId, {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                className: 'btn btn-primary'
            },
            {
                extend: 'csvHtml5',
                title: exportName,
                className: 'btn btn-success', // Green button for CSV
                exportOptions: {
                    columns: exportedColumns
                },
                bom: true
            },
            {
                extend: 'pdfHtml5',
                title: exportName,
                className: 'btn btn-danger', // Red button for PDF
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: exportedColumns,
                    modifier: {
                        page: 'current'
                    }
                },
                customize: function (doc) {
                    doc.content[0].text = formatExportTitle(exportName);
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 10;
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    doc.content[1].layout = {
                        hLineWidth: function (i, node) {
                            return (i === 0 || i === node.table.body.length) ? 2 : 1;
                        },
                        vLineWidth: function (i, node) {
                            return (i === 0 || i === node.table.widths.length) ? 2 : 1;
                        },
                        hLineColor: function (i, node) {
                            return (i === 0 || i === node.table.body.length) ? 'black' : 'gray';
                        },
                        vLineColor: function (i, node) {
                            return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray';
                        }
                    };
                }
            },
            {
                extend: 'print',
                className: 'btn btn-primary'
            },
            {
                extend: 'colvis',
                className: 'btn btn-primary'
            }
        ]
    });
}

function formatExportTitle(exportName) {
    const parts = exportName.split('_');
    if (parts.length < 5) return exportName; 

    const type = parts[1].charAt(0).toUpperCase() + parts[1].slice(1); 
    const category = parts[2].charAt(0).toUpperCase() + parts[2].slice(1); 
    const date = parts[3].match(/(\d{4})(\d{2})(\d{2})/);
    const time = parts[4].match(/(\d{2})(\d{2})(\d{2})/);

    if (!date || !time) return exportName; 

    const formattedDate = `${date[1]}-${date[2]}-${date[3]}`;
    const formattedTime = `${time[1]}:${time[2]}:${time[3]}`;

    return `${type} ${category} Report - ${formattedDate} ${formattedTime}`;
}
