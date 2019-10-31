function getAllClientGroups(){

    $.ajax({
        url: 'groups2',
        method: 'post',
        success: function(res){
            alert(JSON.stringify(res));
        },
        error: function(){
            alert('failure');
        },
    })
}