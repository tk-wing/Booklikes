$(function() {

    // 本棚登録のバリデーション
    $('.AjaxForm').on('submit', function() {
        event.preventDefault();
        var bookId = $(this).siblings('.book_id').text();
        var bookshelf = $(this).find('[name=bookshelf]').val();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                url:'/book/' + bookId + '/bookshelf/' + bookshelf,
                type:'post',
                dataType:'json',
                data:{
                    'bookshelf': bookshelf,
                },
            })
            .done(function(data){
                location.href = data.responseText;
            })
            .fail(function(err){
                form.find('.form-control').addClass('is-invalid');
                var errors = err.responseJSON.errors.bookshelf;
                errors.forEach(function(error){
                    $(form.find('.result')).append('<li>'+error+'</li>');
                });
            })

    });

    // いいね
    $(document).on('click', '.like', function() {
        var feed_id = $(this).siblings('.feed_id').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Content-type": "application/json"
              },
            url:'/like/' + feed_id,
            type:'post',
            data:{
            }
        })
        .done(function(){
                like_count++;
                like_btn.siblings('.like_count').text(like_count);
                like_btn.removeClass('like');
                like_btn.addClass('unlike');
                like_btn.html('<i style="color: red;" class="fas fa-heart"></i>');
        })
        .fail(function(err){
          console.log('error');
        })

    });

    $(document).on('click', '.unlike', function(){
        var feed_id = $(this).siblings('.feed_id').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();

      $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            "Content-type": "application/json"
          },
          url: '/like/' + feed_id,
          type:'delete',
          data:{
          }

      })
      .done(function(){
            like_count--;
            like_btn.siblings('.like_count').text(like_count);
            like_btn.removeClass('unlike');
            like_btn.addClass('like');
            like_btn.html('<i class="far fa-heart"></i>');
      })
      .fail(function(err){
        console.log('error');
      })

    });

});
