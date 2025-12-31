  </main>

  <script>
    AOS.init({ duration: 950, once: true });

    // Helper SweetAlert
    function toast(type, title, text=''){
      Swal.fire({icon:type,title:title,text:text,toast:true,position:'top-end',
                 showConfirmButton:false,timer:2000,timerProgressBar:true})
    }

    // Konfirmasi hapus (link memiliki class .btn-delete dan data-href)
    document.addEventListener('click', e=>{
      const t = e.target.closest('.btn-delete');
      if(!t) return;
      e.preventDefault();
      Swal.fire({
        title:'Hapus data ini?', icon:'warning',
        showCancelButton:true, confirmButtonText:'Ya, hapus',
        cancelButtonText:'Batal', confirmButtonColor:'#b91c1c'
      }).then(res=>{
        if(res.isConfirmed){ window.location = t.dataset.href; }
      });
    });
  </script>
</body>
</html>
