const showReply = document.querySelectorAll('.reply-comment-btn')
const replyCommentForm = document.querySelector('#reply-comment')

showReply.forEach(element =>{
    $(element).click(function(){
        $(replyCommentForm).toggle("slow")
        if ($(element).text()==='Reply'){
            $(element).text('Cancel')
        } else{
            $(element).text('Reply')
        }
    })
})
