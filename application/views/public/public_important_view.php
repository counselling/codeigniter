<h1>Important Information</h1><hr><br/><br/><p><b>You are receiving this message because we have recently upgraded our site to improve your security and to provide        you with the ability to choose your own password.        <br/><br/>        As part of this process you now need to reset your password. Please click the 'Set Up My Password' button below.        <br/><br/>        Passwords are case sensitive and should be at least 8 characters and must contain at least one lower case        letter, one upper case letter and one digit.<br/>        <br/><br/>        You will receive an email at your registered address.<br/>The email will contain a link which will connect you        with our site and enable you set up a new password    </b></p><br/><p><b>Please use the link in the email to reset your password.    </b></p><br/><p><b>Please note that the link will only remain active for a limited time after which time you will have to apply again.        <br/><br/>        After you have reset your password you will not be shown this screen again.    </b></p><br/><br/><?php $hidden = array('email' => $this->session->flashdata('email')) ?><?php echo form_open("general/set_up_password", "", $hidden); ?><p align="center"><?php    $submit_data = array(        'name' => 'Submit',        'type' => 'submit',        'value' => 'Set Up My Password',        'style' => 'width:150px; margin 0px auto'    );    echo form_submit($submit_data);?></p><?php echo form_close(); ?>