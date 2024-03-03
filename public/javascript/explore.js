var paginate = 1;
var dataExplore = [];
loadMoreData(paginate);
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        paginate++;
        loadMoreData(paginate);
    }
})

function loadMoreData(paginate) {
    var urlnya = window.location.href.split("?")[1];
    var parameter = new URLSearchParams (urlnya);
    var carivalue = parameter.get('cari');
    if  (carivalue == 'null'){
        url =  window.location.origin +'/getDataExplore'+ '?page='+paginate;
    } else{
        url = window.location.origin +'/getDataExplore?cari=' +carivalue + '&page='+paginate;
    }    $.ajax({
        url:url,
        type: "GET",
        dataType: "JSON",
        success: function (e) {
            console.log(e)
            e.data.data.map((x) => {
                var hasilPencarian = x.like.filter(function(hasil){
                    return hasil.users_id === e.idUser
                })
                if(hasilPencarian.length <= 0) {
                    userlike = 0;
                } else {
                    userlike = hasilPencarian[0].users_id;
                }

                // var hasilPencarianFavorite = x.favorite.filter(function(hasil){
                //     return hasil.id_user === e.idUser
                // })
                // if(hasilPencarianFavorite.length <= 0) {
                //     userfavorite = 0;
                // } else {
                //     userfavorite = hasilPencarianFavorite[0].id_user;
                // }

                let datanya = {
                    id: x.id,
                    idUser: x.users_id,
                    judul_foto: x.judul_foto,
                    deskripsi: x.deskripsi,
                    foto: x.lokasi_foto,
                     tanggal: x.created_at,
                     jml_komentar: x.komentar_count,
                     jml_like: x.like_count,
                    idUserLike: userlike,
                    useractive: e.idUser,
                    // userfavorite: userfavorite
                }
                dataExplore.push(datanya)
                // console.log(userlike)
                // console.log(e.idUser)
            })
            getExplore()
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    })
}

const getExplore = () => {
    $('#exploredata').html('')
    dataExplore.map((x, i) => {
        $('#exploredata').append(
            `
            <div class="flex mt-2 bg-white border border-gray-300 rounded" style="border-color: black;">

            
                <div class="flex flex-col px-2">
                    <a href="/explore-detail/${x.id}">
                    <div class="w-1/4">
                </div>

                        <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden m-2">
                            <img src="/unggah/${x.foto}" alt="" class="w-full border border-gray-400 transition duration-500 ease-in-out hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                    ${x.judul_foto}
                                </div>
                                <div class="text-xs text-abuabu">
                                <div class="text-xs text-gray-700">
                                ${new Date(x.tanggal).toLocaleString("id", {
                                    day: "2-digit",
                                    month: "long",
                                    year: "numeric",
                                    hour: "2-digit",
                                    minute: "2-digit"
                                })}
                            </div>
                            
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="/explore-detail/${x.id}">
                            <span class="bi bi-chat-left-text" style="font-size: 1.5em;"></span>
                            <small>${x.jml_komentar}</small>
                            </a>
                            <small></small>
                            <span class="bi ${x.idUserLike === x.useractive ? 'bi-heart-fill' : 'bi-heart'}" onclick="likes(this, ${x.id})" style="font-size: 1.5em;"></span>
                            <small>${x.jml_like}</small>
                        </div>
                    </div>
                </div>
            </div>
        `
        )
    })
}


function likes (txt, id) {
    $.ajax({
        url: window.location.origin +'/likefotos',
        dataType: "JSON",
        type: "POST",
        data: {
            _token: $('input[name="_token"]').val(),
            fotoid: id,
            },
            success: function(res) {
                console.log(res)
                location.reload()

            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('gagal')
        }
    })

}



// function pinned (txt, id) {
//     $.ajax({
//         url: window.location.origin +'/pinned',
//         dataType: "JSON",
//         type: "POST",
//         data: {
//             _token: $('input[name="_token"]').val(),
//             idfoto: id,
//             },
//             success: function(res) {
//                 console.log(res)

//             },
//             error: function(jqXHR, textStatus, errorThrown){
//                 alert('gagal')
//         }
//     })
// }