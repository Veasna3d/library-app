//display Function 
function PrintReport(){
    $("#div_print").printThis({
        debug: false,
        importCSS: true,
        importStyle: true,
        printContainer: true,
        loadCSS: ["../PDO_Report/css/bootstrap.min.css"],
        pageTitle: "",
        removeInline: false,
        removeInlineSelector: "*",
        printDelay: 333,
        header: null,
        fooder: null,
        base: false,
        formValues: true,
        canvas: true,
        doctypeString: '...',
        removeScripts: false,
        copyTagClasses: false,
        beforePrintEvent: null,
        beforePrint: null,
        afterPrint: null
    });
}

