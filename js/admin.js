/* DB Tagcloud Preview in Admin Panel */

const dbTagcloudPreview = document.getElementById("db_tgcl_preview").getElementsByClassName("db-tagcloud")[0];
const dbTagcloudPreviewAnchors = dbTagcloudPreview.getElementsByTagName("a");
const dbTagcloudCols = document.getElementById("db_tgcl_cols");
const dbTagcloudFontsize = document.getElementById("db_tgcl_fontsize");
const dbTagcloudFontweight = document.getElementById("db_tgcl_fontweight");
const dbTagcloudBorderwidth = document.getElementById("db_tgcl_borderwidth");
const dbTagcloudColor = document.getElementById("db_tgcl_color");

let dbTagcloudColsOldNumber = dbTagcloudCols.value;

dbTagcloudCols.addEventListener('focus', function(){

    dbTagcloudColsOldNumber = dbTagcloudCols.value;

});


dbTagcloudCols.addEventListener('change', function(){

    let cols = dbTagcloudCols.value;

    dbTagcloudPreview.classList.remove("db-cols-" + dbTagcloudColsOldNumber);
    dbTagcloudPreview.classList.add("db-cols-" + cols);

});


dbTagcloudFontsize.addEventListener('change', function(){

    let fontsize = dbTagcloudFontsize.value;

    dbTagcloudPreview.style.fontSize = fontsize + "px";

});


dbTagcloudFontweight.addEventListener('change', function(){

    let fontweight = dbTagcloudFontweight.value;

    switch (fontweight) {
        case '0':
            dbTagcloudPreview.style.fontWeight = "400";
            dbTagcloudPreview.style.fontStyle = "normal";
            break;
        case '1':
            dbTagcloudPreview.style.fontWeight = "700";
            dbTagcloudPreview.style.fontStyle = "normal";
            break;
        case '2':
            dbTagcloudPreview.style.fontWeight = "400";
            dbTagcloudPreview.style.fontStyle = "italic";
            break;
        case '3':
            dbTagcloudPreview.style.fontWeight = "700";
            dbTagcloudPreview.style.fontStyle = "italic";
            break;
    }

});


dbTagcloudBorderwidth.addEventListener('change', function(){

    let borderwidth = dbTagcloudBorderwidth.value;

    for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )

       dbTagcloudPreviewAnchor.style.borderWidth = borderwidth + "px";        

});


jQuery(document).ready(function($){
    $('.db-tgcl-color').wpColorPicker();
});


jQuery('.wp-color-picker').wpColorPicker({
    /**
     * @param {Event} event - standard jQuery event, produced by whichever
     * control was changed.
     * @param {Object} ui - standard jQuery UI object, with a color member
     * containing a Color.js object.
     */
    change: function (event, ui) {
        var element = event.target;
        var color = ui.color.toString();
    
        for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )
    
           dbTagcloudPreviewAnchor.style.borderColor = color;
    },

    /**
     * @param {Event} event - standard jQuery event, produced by "Clear"
     * button.
     */
    clear: function (event) {
        var element = jQuery(event.target).siblings('.wp-color-picker')[0];
        var color = '';

        if (element) {
    
            for ( let dbTagcloudPreviewAnchor of dbTagcloudPreviewAnchors )
        
               dbTagcloudPreviewAnchor.style.borderColor = color;
        }
    }
});