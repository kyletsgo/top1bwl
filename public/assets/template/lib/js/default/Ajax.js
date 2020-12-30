var Ajax = function(url,type,success,error){
    $.ajax({
        url: url,
        type: type,
        dataType: 'json',
        success: function(d){
            var data = d.data;
            success && success(data);
        },
        error: function(e){
            error && error(e)
        }
    })
}

Ajax('/data.json','get',function(data){
    console.log(data)
})