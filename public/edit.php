<head>
    <style>
    @media only screen and (min-width:820px) {
        .edit{
            width:80%;
        }
    }
    @media only screen and (max-width:820px) {
        .edit{
            width:100%;
        }
    }





    </style>
</head>
<body>
<div class=" 12u recipe edit">
     <div class=" card card-body 12u 12u(mobilep) " style="color:black">
        <form  method="POST">
            <div class="row uniform 50%">
                <input id="recipe_id" name="recipe_id" <?php echo 'value = "'.$_POST['recipe_id'].'"'?> type="hidden"/>
                <input id="recipe_title" name="recipe_title" <?php echo 'value = "'.$_POST['recipe_title'].'"'?> type="hidden"/>
                <div class="12u">
                    <label for="quantity">Quantity</label>
                    <input style="height:45px" id="quantity" type="number" name="quantity"  placeholder="" min="1" class="form-control" <?php echo 'value = "'.$_POST['quantity'].'"'?>/>
                </div>
                <div class="12u">
                    <label for="day">Select Day</label>
                    <select name="day" class="form-control" id="day" style="height:45px" <?php echo 'value = "'.$_POST['day'].'"'?>>
                        <option <?php echo strcmp($_POST['day'],'Monday')=== 0?'selected':''; ?> class="Monday">Monday</option>
                        <option <?php echo strcmp(trim($_POST['day']),'Tuesday')=== 0?'selected':'' ; ?> class="Tuesday">Tuesday</option>
                        <option <?php echo strcmp($_POST['day'],'Wednesday')=== 0?'selected':''; ?> class="Wednesday">Wednesday</option>
                        <option <?php echo strcmp($_POST['day'],'Thursday')=== 0?'selected':''; ?> class="Thursday">Thursday</option>
                        <option <?php echo strcmp($_POST['day'],'Friday')=== 0?'selected':''; ?> class="Friday">Friday</option>
                        <option <?php echo strcmp($_POST['day'],'Saturday')=== 0?'selected':''; ?> class="Saturday">Saturday</option>
                        <option <?php echo strcmp($_POST['day'],'Sunday')=== 0?'selected':''; ?> class="Sunday">Sunday</option>
                    </select>
                </div>
                <div class="12u">
                    <label for="week">Select Week</label>
                    <select name="week" class="form-control" id="week"  style="height:45px" <?php echo 'value = "'.$_POST['week'].'"'?>>
                        <option <?php echo strcmp($_POST['week'],'Week 1')=== 0?'selected':''; ?> class="Week 1">Week 1</option>
                        <option <?php echo strcmp($_POST['week'],'Week 2')=== 0?'selected':''; ?> class="Week 2">Week 2</option>
                        <option <?php echo strcmp($_POST['week'],'Week 3')=== 0?'selected':''; ?> class="Week 3">Week 3</option>
                        <option <?php echo strcmp($_POST['week'],'Week 4')=== 0?'selected':''; ?> class="Week 4">Week 4</option>
                    </select>
                </div>
                <div class="12u">
                    <button name="add" id="add_recipe" class="button alt  add-recipe" style="text-align:center">Submit</button>
                    <button  id="remove" class="button special" style="text-align:center; float:right">Delete</button>
                </div>
            </div>
        </form>
    </div>
 </div>
 <div class="hidden-modal"><div class="modal fade" id="myModal" style="margin-top:50px">
<div class="modal-dialog">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<h4 class="modal-title">Add New Recipe</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<!-- Modal body -->
<div class="modal-body" >
<h4  id="msg" style="color:green">Recipe succesfully updated.</h4>
</div>

<!-- Modal footer -->
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>

</div>
</div>
</div>

 <script>$.getScript('/assets/js/edit.js')</script>
</body>
