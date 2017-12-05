function uploadFileSt(target) {
    var output = '<br><br><ul>';
    for (var i = 0; i < target.files.length; ++i) {
        output += '<li>' + target.files[i].name + '</li>';
    }
    output += '</ul>';

    document.getElementById("file-list-st").innerHTML = output;
}