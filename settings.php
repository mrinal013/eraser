<h1>Delete post from one place</h1>
Start Date: <input type="date" name="start_date" /><br/>
End Date: <input type="date" name="end_date" /><br/>
Post Type:
<select name="post_type" id="pType">
<?php
foreach ( get_post_types( '', 'names' ) as $post_type ) {
   echo '<option>' . $post_type . '</option>';
}
?>
</select>
<input class="postType" type="hidden" name="postType_id" value="<?php echo $_SESSION['postType_id'] ?>">

<br/>
<p class="pType"></p>
<?php
submit_button('Delete', 'delete');




