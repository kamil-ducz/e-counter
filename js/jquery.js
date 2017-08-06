var query = 'http://webtask.future-processing.com:8068/currencies&callback=?';
$.ajax({
    url: query,
    type: 'GET',
    dataType: 'json',
    success: function(s) { 
       console.log('success' + s)
    },
    error: function(e) { console.log('something went wrong!', e)}
});

