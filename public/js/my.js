$(function() {

    // 本棚登録のバリデーション
    $(document).on('click', '.add', function() {
    var bookId = $(this).siblings('.book_id').text();
    // 選択されているvalue属性値を取り出す
    var bookshelf = $(this).siblings('[name=bookshelf]').val();
    console.log(bookshelf);
    console.log(bookId);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                "Content-type": "application/json"
              },
            url:'/book/' + bookId + '/bookshelf/' + bookshelf,
            type:'post',
            data:{
            }
        })
        .done(function(data){
            location.href = data;
        })
        .fail(function(err){
            console.log('error');
        })

    });

    // いいねカウント
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
