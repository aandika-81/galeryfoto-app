var segmenTerakhir = window.location.href.split('/').pop();

$.ajax({
    url: window.location.origin +'/explore-detail/'+segmenTerakhir+'/getdatadetail',
    type: "GET",
    dataTYpe: "JSON",
    success: function(res){
        console.log(res)
$('#profile').prop('src','/profile/'+res.dataDetailFoto.user.foto_profile)
$('#fotodetail').prop('src','/unggah/'+res.dataDetailFoto.lokasi_foto)
$('#judul').html(res.dataDetailFoto.judul_foto)
$('#deskripsi').html(res.dataDetailFoto.deskripsi)
$('#username').html(res.dataDetailFoto.user.username)
ambilKomentar()
    },
    eorror: function(jqXHR, textStatus, errorThrown){
        alert('gagal')
    }
})



function ambilKomentar(){
    $.getJSON(window.location.origin +'/explore-detail/getComment/'+segmenTerakhir, function(res){
        console.log(res)
        if(res.data.length === 0){
            $('#listkomentar').html('<div>belum ada komen</div>')
        } else {
            comment= []
            res.data.map((x)=>{
                let datakomen = {
                    idUser: x.user.id,
                    pengirim: x.user.username,
                    waktu: x.created_at,
                    isi_komentar: x.isi_komentar,
                    potopengirim: x.user.foto_profile
                }
                comment.push(datakomen);
            })
            tampilkankomentar()
        }
    })
}

const tampilkankomentar = ()=>{
    $('#listkomentar').html('')
    comment.map((x, i)=>{
        $('#listkomentar').append(`
            <div class="flex flex-row justify-start mt-4">
                <div class="w-1/4">
                    <img src="/profile/${x.potopengirim}"  alt="" class="w-14 h-14 rounded-full">
                </div>
                <div class="flex flex-col mr-2">
                    <h5 class="text-sm">${x.pengirim}</h5>
                    <small class="text-xs text-abuabu">${new Date(x.waktu).toLocaleDateString("id")}</small>
                </div>
                    <h5 class="text-sm">${x.isi_komentar}</h5>
            </div>
        `)
    })
}

function kirimkomentar(){
    $.ajax({
        url: window.location.origin +'/explore-detail/kirimkomentar',
        type: "POST",
        dataType: "JSON",
        data: {
            _token: $('input[name="_token"]').val(),
            fotoid: segmenTerakhir,
            isi_komentar: $('input[name="isikomentar"]').val(),
        },
        success: function(res){
            // $('input[name="isikomentar"]').val('')
            // console.log(res)
            location.reload()

        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('gagal')
        }
    })
}
