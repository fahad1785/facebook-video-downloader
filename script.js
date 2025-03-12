function downloadVideo() {
    let url = document.getElementById('videoUrl').value;
    
    $.ajax({
        url: 'download.php',
        type: 'GET',
        data: { videoUrl: url },
        success: function(response) {
            document.getElementById('result').innerHTML = `<a href="${response}" download>Click to Download Video</a>`;
        }
    });
}


