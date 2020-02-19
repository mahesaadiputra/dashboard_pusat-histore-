function MessageReceived(data) {
    const message = JSON.parse(data.data.data);
    console.log('new Message : ', message);
    // let MainUrl = window.location.origin;
    // const type = message.type;
    AppendData(message);
    /*
    To Do List
    -Listing Access List API
    -API Update Opened Message
    */
}

const original_title = document.title;

function AppendData(data) {
    const url = window.location.origin;


    const badge = $('#badgeNotif');
    const badgeNotif = Number(badge.html());
    const numBadge = badgeNotif + 1;
    badge.html(numBadge);

    document.title = `(${numBadge}) ${original_title}`;

    let originUrl;

    console.log(url);

    switch(data.type){
        case 0:
        //Pusat
        originUrl = `${url}/order/edit/${data.transaction_id}`;
        ;break;
        case 1:

        ;break;
        case 2:

        ;break;
        case 3:

        ;break;
        case 4:

        ;break;
    }

    $('#notifAppend').append(`
        <a href="${originUrl}" class="dropdown-item clear-title" id="${data.transaction_id}">
            <i class="fas fa-envelope mr-2"></i> ${data.message}
         </a>
        <div class="dropdown-divider"></div>
        `);
}

// $(document).ready(function(){
//     console.log('asdasdasd');
//     // $('#notifAppend').on('click', '.clear-title',function(e){
//     //     e.preventDefault();
//     //     const id = $(this).attr('id');
//     //     console.log(id);
//     //     document.title = original_title;
//     // })
//     // $('#fetchall').on('click', function(e){
//     //   e.preventDefault();
//     //     const id = $(this).attr('id');
//     //     console.log(id);
//     //     document.title = original_title;
//     // })
//     const url = $('#logoutData').attr('href');
//     console.log(url);
// })