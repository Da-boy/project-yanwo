var id = setTimeout('loadPage()',800);
function loadPage() {
    var readystate = document.readyState.toLowerCase();
    if (readystate == 'complete')
    {
        clearTimeout(id);
        document.getElementById('loadpagediv').style.display =  "none";
    }
    else {
        document.getElementById('loadpagediv').style.display =  "block";
        id = setTimeout('loadPage()',100);
    }

}