function createDataTable(tableId, exportName, pricingTable = false) {
    exportedColumns = pricingTable == true ? ':visible' : ':not(:last-child)';

    new DataTable(tableId, {
        // responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', {
                extend: 'csvHtml5',
                title: exportName,
                exportOptions: {
                    // Exclude the last column (Action column in this case)
                    columns: exportedColumns
                },
                bom: true
            }, {
            extend: 'pdfHtml5',
            title: exportName,
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

function formatExportTitle(fileName) {
    // Split the file name into parts: 'export_cash_sale_20220202_141115'
    const parts = fileName.split('_');

    // The page title is the second part and we convert it to a human-readable format (capitalize each word and replace underscores with spaces)
    let formattedTitle = parts.slice(1, -2).join(' ').replace(/\b\w/g, char => char.toUpperCase());

    // Extract the date from the third part (in the format YYYYMMDD)
    const dateString = parts[parts.length - 2];
    const year = dateString.substring(0, 4);
    const month = dateString.substring(4, 6);
    const day = dateString.substring(6, 8);

    // Create a human-readable date (e.g., 'February 2, 2022')
    const date = new Date(`${year}-${month}-${day}`);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const readableDate = date.toLocaleDateString('en-US', options);

    // Combine the formatted title with the human-readable date
    return `${formattedTitle} ${readableDate}`;
}