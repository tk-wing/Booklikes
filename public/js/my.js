$(function() {
    // 新規登録
    $(document).on('click', '#register', function() {
        var name = $(this).find('#name').text();
        var email = $(this).find('#email').text();
        var pw = $(this).find('#password').text();
        var img_name = $(this).find('#img_name').text();
        $.ajax({
            url:'register.php',
            type:'POST',
            datatype: 'json',
            data:{
              'name':name,
              'email':email,
              'pw':pw,
              'img_name':img_name,
            }
        })
        .done(function(data){
          console.log('true');
        })
        .fail(function(err){
          console.log('error');
        })

    });

    // カテゴリーのアコーディオン
    $(document).on('click', '#category', function(){
      var content = $(this).find('.contents');
      content.addClass('open');
      content.slideDown();
      $(this).find('#index').text('-');
    });

    // いいねカウント
    $(document).on('click', '.like', function() {
        var feed_id = $(this).siblings('.feed_id').text();
        var user_id = $('#signin_user').text();
        var like_btn = $(this);
        var like_count = $(this).siblings('.like_count').text();

        // console.log(like_count);

        console.log(feed_id);
        console.log(user_id);

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
          // 目的の処理が失敗したときの処理
          console.log('error');
        })

    });

    $(document).on('click', '.unlike', function(){
        var feed_id = $(this).siblings('.feed_id').text();
        var user_id = $('#signin_user').text();
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
