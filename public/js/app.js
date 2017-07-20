//Post Edit and Save

var postId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.edit').on('click', function(event){
    
    event.preventDefault();
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody); 
    $('#edit-modal').modal();
});

$('#model-save').on('click', function(){
    $.ajax({
        method  : 'POST',
        url     : url,
        data    : { body: $('#post-body').val(), postId: postId, _token: token}
    })
    
    .done(function(msg){
        $(postBodyElement).text(msg['new_body']);
        $('#edit-modal').modal('hide');
    });
});







//Post Like

$('.like').click('on', function(event){
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: { isLike: isLike, postId: postId, _token: token },
        success: function(msg){
            //alert(msg);
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            if(isLike){
                event.target.nextElementSibling.innerText = 'Dislike';
            }
            else{
                event.target.previousElementSibling.innerText = 'Like';
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
            alert('Some Error');
        }
    });
    
    
});






//Delete Confirm

$('.delete').click('on', function(event){
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    if(confirm("Are you sure to Delete?")){
        $.ajax({
            method: 'POST',
            url: urlDelete,
            data: { postId: postId, _token: token },
            success: function(msg){
                //alert(msg);
                
                postBodyElement = event.target.parentNode.parentNode;
                
                postBodyElement.style.display = 'none';
                
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert('Some Error');
            }
        });    
    }
    else{
        return null;
    }

});