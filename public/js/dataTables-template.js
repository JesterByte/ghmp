function createDataTable(tableId, exportName) {
    new DataTable(tableId, {
        // responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', {
                extend: 'csvHtml5',
                title: exportName,
                exportOptions: {
                    // Exclude the last column (Action column in this case)
                    columns: ':not(:last-child)'
                }
            }, {
            extend: 'pdfHtml5',
            title: exportName,
            orientation: 'landscape',
            pageSize: 'A4',
            exportOptions: {
                columns: ':not(:last-child)',
                modifier: {
                page: 'current'
                }
            },
            customize: function (doc) {
                doc.defaultStyle.fontSize = 8; // Set default font size for all text
                doc.styles.tableHeader.fontSize = 10; // Set font size for table headers
                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split(''); // Auto adjust column widths
                doc.content[1].layout = {
                hLineWidth: function (i, node) {
                    return (i === 0 || i === node.table.body.length) ? 2 : 1; // Set horizontal line width
                },
                vLineWidth: function (i, node) {
                    return (i === 0 || i === node.table.widths.length) ? 2 : 1; // Set vertical line width
                },
                hLineColor: function (i, node) {
                    return (i === 0 || i === node.table.body.length) ? 'black' : 'gray'; // Set horizontal line color
                },
                vLineColor: function (i, node) {
                    return (i === 0 || i === node.table.widths.length) ? 'black' : 'gray'; // Set vertical line color
                }
                };
            }
            }, 'print', 'colvis'
        ]
    });
}