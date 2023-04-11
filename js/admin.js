/* DB Tagcloud Preview in Admin Panel */

const dbTagcloudPreview = document.getElementById("db_tgcl_preview").getElementsByClassName("db-tagcloud")[0];
const dbTagcloudPreviewAnchors = dbTagcloudPreview.getElementsByTagName("a");
const dbTagcloudCols = document.getElementById("db_tgcl_cols");
const dbTagcloudFontsize = document.getElementById("db_tgcl_fontsize");
const dbTagcloudFontweight = document.getElementById("db_tgcl_fontweight");
const dbTagcloudBorderwidth = document.getElementById("db_tgcl_borderwidth");

let dbTagcloudColsOldnumber = dbTagcloudCols.value;

dbTagcloudCols.addEventListener('focus', function(){

    dbTagcloudColsOldnumber = dbTagcloudCols.value;

});


dbTagcloudCols.addEventListener('change', function(){

    let cols = dbTagcloudCols.value;

    dbTagcloudPreview.classList.remove("db-cols-" + dbTagcloudColsOldnumber);
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