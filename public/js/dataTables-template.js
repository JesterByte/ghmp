function createDataTable(tableId, exportName, pricingTable = false) {
    exportedColumns = pricingTable == true ? ':visible' : ':not(:last-child)';

    let sorting;
    let visible;
    switch (pricingTable) {
        case true:
            sorting = "asc";
            visible = true;
            break;
        case false:
            sorting = "desc";
            visible = false;
            break;
    }

    // Set the first column (index 0) to be sorted in descending order by default
    const orderOptions = [[0, sorting]]; // Sorting the first column in descending order

    new DataTable(tableId, {
        dom: 'Bfrtip',
        order: orderOptions,  // Apply the sorting order here
        columnDefs: [
            {
                targets: 0, // Specify the first column (index 0)
                visible: visible // Hide the first column
            }
        ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn btn-primary',
                exportOptions: {
                    columns: function (idx, data, node) {
                        // Exclude the first column from copy export
                        return idx !== 0; // Exclude the first column (index 0)
                    }
                }
            },
            {
                extend: 'csvHtml5',
                title: exportName,
                className: 'btn btn-success', // Green button for CSV
                exportOptions: {
                    columns: function (idx, data, node) {
                        // Exclude the first column from CSV export
                        return idx !== 0; // Exclude the first column (index 0)
                    }
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
                    columns: function (idx, data, node) {
                        // Exclude the first column from PDF export
                        return idx !== 0; // Exclude the first column (index 0)
                    },
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
                className: 'btn btn-primary',
                exportOptions: {
                    columns: function (idx, data, node) {
                        // Exclude the first column from print export
                        return idx !== 0; // Exclude the first column (index 0)
                    }
                }
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
