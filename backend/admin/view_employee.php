<?php
require_once("../DBConnection.php");
if(isset($_GET['id'])){
$qry = $conn->query("SELECT e.*, d.name as department FROM `employee_list`e inner join department_list d on e.department_id = d.department_id where e.employee_id = '{$_GET['id']}'");
    foreach($qry->fetchArray() as $k => $v){
        $$k = $v;
    }
}
$thumbnail = '../uploads/employees/'.$employee_id.'.png';
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
    #employee-image{
        width:calc(100%);
        height:20vh;
        object-fit:scale-down;
        object-position:center center
    }
</style>

<div class="container-fluid" id="employee-details">
    <div class="col-12">
        <div class="row aling-items-middle">
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <img src="<?php echo $thumbnail ?>" id="employee-image" alt="Img" class="display-image image-fluid border-dark">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <dl>
                    <dt class="text-info">Student Code</dt>
                    <dd class="ps-4"><?php echo isset($employee_code) ? $employee_code : '' ?></dd>
                    <dt class="text-info">Fullname</dt>
                    <dd class="ps-4"><?php echo isset($fullname) ? ucwords($fullname) : '' ?></dd>
                    <dt class="text-info">Gender</dt>
                    <dd class="ps-4"><?php echo isset($gender) ? $gender : '' ?></dd>
                    <dt class="text-info">Date of Birth</dt>
                    <dd class="ps-4"><?php echo isset($dob) ? date("M d, Y",strtotime($dob)) : '' ?></dd>
                    <dt class="text-info">Contact #</dt>
                    <dd class="ps-4"><?php echo isset($contact) ? $contact : '' ?></dd>
                    <dt class="text-info">Address</dt>
                    <dd class="ps-4"><?php echo isset($address) ? $address : '' ?></dd>
                    <dt class="text-info">Department</dt>
                    <dd class="ps-4"><?php echo isset($department) ? $department : '' ?></dd>
                    <dt class="text-info">Student Type</dt>
                    <dd class="ps-4"><?php echo isset($type) ? $type : '' ?></dd>
                    <dt class="text-info">Email</dt>
                    <dd class="ps-4"><?php echo isset($email) ? $email : '' ?></dd>
                    <dt class="text-info"></dt>
                </dl>
            </div>Student
        </div>
    </div>
    <div class="col-12">
        <div class="row justify-content-end">
            <div class="col-1">
                <div class="btn btn btn-dark btn-sm rounded-0" type="button" data-bs-dismiss="modal">Close</div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        if('<?php echo isset($_GET['borrowed_id']) ?>' == 1){
            $('#uni_modal').on('hidden.bs.modal',function(){
                if($('#uni_modal #employee-details').length > 0)
                uni_modal('Borrowed Details',"view_borrowed.php?id=<?php echo isset($_GET['borrowed_id']) ? $_GET['borrowed_id'] : '' ?>",'large')
            })
        }
    })
    function delete_img($path){
        $('#confirm_modal button').attr('disabled',true)
        $.ajax({
            url:"../Actions.php?a=delete_img",
            method:"POST",
            data:{path:$path},
            dataType:'json',
            error:err=>{
                console.log(err)
                alert("An error occurred.")
            },
            success:function(resp){
                if(resp.status == 'success'){
                    $('.img-del-btn>.btn[data-path="'+$path+'"]').closest('.img-item').remove()
                    $('#confirm_modal').modal('hide')
                }else{
                    console.log(resp)
                    alert("An error occurred.")
                }
            $('#confirm_modal button').attr('disabled',false)
            }
        })
    }
</script>