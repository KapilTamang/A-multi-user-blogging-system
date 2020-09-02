// User Role Edit Modal 
    <script>
        $('#RoleEditModal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget);// Button that triggered the modal
            var userName = button.data('user') // Extract info from data-* attributes
            var role = button.data('role')
            var myroute = button.data('route')
           
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            
            if(role === 1) {
                modal.find('#admin').attr('checked', 'checked')
            }
            else if(role ===2) {
                modal.find('#author').attr('checked', 'checked')
            }
            else if(role === 3) {
                modal.find('#subscriber').attr('checked', 'checked')
            }

            modal.find('.close').click(function() {
                modal.find('#admin').removeAttr('checked', 'checked')
                modal.find('#author').removeAttr('checked', 'checked')
                modal.find('#subscriber').removeAttr('checked', 'checked')
                
            }) 

            modal.find('.btn-close').click(function() {
                modal.find('#admin').removeAttr('checked', 'checked')
                modal.find('#author').removeAttr('checked', 'checked')
                modal.find('#subscriber').removeAttr('checked', 'checked')
            }) 

            modal.find('.modal-body #username').html(userName)
            modal.find('#role-edit-form').attr('action', myroute)          
        })
    </script>
