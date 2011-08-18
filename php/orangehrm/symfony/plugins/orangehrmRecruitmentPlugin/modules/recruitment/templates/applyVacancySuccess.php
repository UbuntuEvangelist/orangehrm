<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA  02110-1301, USA
 *
 */
?>

<link href="<?php echo public_path('../../themes/orange/css/ui-lightness/jquery-ui-1.7.2.custom.css') ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo public_path('../../scripts/jquery/ui/ui.core.js') ?>"></script>
<?php use_stylesheet('../orangehrmRecruitmentPlugin/css/applyVacancySuccess'); ?>
<?php use_javascript('../orangehrmRecruitmentPlugin/js/applyVacancySuccess'); ?>
<?php $browser = $_SERVER['HTTP_USER_AGENT']; ?>
<?php if (strstr($browser, "MSIE 8.0")): ?>
    <?php $keyWrdWidth = 'width: 276px' ?>
    <?php $resumeWidth = 37 ?>
<?php else: ?>
    <?php $keyWrdWidth = 'width: 271px' ?>
    <?php $resumeWidth = 38; ?>
<?php endif; ?>

<div id="messagebar" class="<?php echo isset($messageType) ? "messageBalloon_{$messageType}" : ''; ?>" >
    <span style="font-weight: bold;"><?php echo isset($message) ? $message : ''; ?></span>
</div>
<div id="addCandidate">
    <div class="outerbox" style="width:700px">

        <div class="mainHeading"><h2 id="addCandidateHeading"><?php echo __("Apply for" . " " . $name); ?></h2></div>
        <form name="frmAddCandidate" id="frmAddCandidate" method="post" enctype="multipart/form-data">

            <?php echo $form['_csrf_token']; ?>
            <?php echo $form["vacancyList"]->render(); ?>

            <br class="clear"/>

            <div class="description">
                <div style="float:left"><label><?php echo __('Description'); ?><span  id="extend">[+]</span></label></div>
                <br class="clear"/>
                <div id="description">
                    <textarea id="txtArea" cols="68" rows="1" onkeyup="expandtextarea(this)"><?php echo $description ?></textarea>
                </div>
            </div>
            <br class="clear"/>
            <div class="nameColumn" id="firstNameDiv">
                <label><?php echo __('Full Name'); ?></label>
            </div>
            <div class="column">
                <?php echo $form['firstName']->render(array("class" => "formInputText", "maxlength" => 35)); ?>
                <div class="errorHolder"></div>
                <br class="clear"/>
                <label id="frmDate" class="helpText"><?php echo __('First Name'); ?><span class="required">*</span></label>
            </div>
            <div class="column" id="middleNameDiv">
                <?php echo $form['middleName']->render(array("class" => "formInputText", "maxlength" => 35)); ?>
                <div class="errorHolder"></div>
                <br class="clear"/>
                <label id="toDate" class="helpText"><?php echo __('Middle Name'); ?></label>
            </div>
            <div class="column" id="middleNameDiv">
                <?php echo $form['lastName']->render(array("class" => "formInputText", "maxlength" => 35)); ?>
                <div class="errorHolder"></div>
                <br class="clear"/>
                <label id="toDate" class="helpText"><?php echo __('Last Name'); ?><span class="required">*</span></label>
            </div>
            <br class="clear"/>
            <br class="clear"/>
            <div class="newColumn">
                <?php echo $form['email']->renderLabel(__('E-Mail'). ' <span class="required">*</span>'); ?>
                <?php echo $form['email']->render(array("class" => "formInputText")); ?>
                <div class="errorHolder below"></div>
            </div>
            <div class="newColumn">
                <?php echo $form['contactNo']->renderLabel(__('Contact No'), array("class " => "contactNoLable")); ?>
                <?php echo $form['contactNo']->render(array("class" => "contactNo")); ?>
                <div class="errorHolder cntact"></div>
            </div>
            <br class="clear" />

            <div class="hrLine" >&nbsp;</div>
            <br class="clear" />
            <div>

                <?php
                if ($form->attachment == "") {
                    echo $form['resume']->renderLabel(__('Resume'. '<span class="required">*</span>'), array("class " => "resume"));
                    echo $form['resume']->render(array("class " => "duplexBox", "size" => $resumeWidth));
                    echo "<div class=\"errorHolder below\"></div><br class=\"clear\"/>";
                    echo "<span id=\"cvHelp\" class=\"helpText\">[" . __(".docx, .doc, .odt, .pdf, .rtf, or .txt with maximum file size of 1MB") . "]</span>";
                } else {
                    $attachment = $form->attachment;
                    $linkHtml = "<a target=\"_blank\" class=\"fileLink\" href=\"";
                    $linkHtml .= url_for('recruitment/viewCandidateAttachment?attachId=' . $attachment->getId());
                    $linkHtml .= "\">{$attachment->getFileName()}</a>";
                    
                    echo "<label>".__("Resume")."</label>";
                    echo $linkHtml;
                    echo "<br class=\"clear\"/>";
                    
                }
                ?>
            <br class="clear"/>
            <div>
                <?php echo $form['keyWords']->renderLabel(__('Keywords'), array("class " => "keywrd")); ?>
                <?php echo $form['keyWords']->render(array("class" => "keyWords")); ?>
                <div class="errorHolder below"></div>
            </div>
            <br class="clear" />
            <div>
                <?php echo $form['comment']->renderLabel(__('Notes'), array("class " => "comment")); ?>
                <?php echo $form['comment']->render(array("class" => "formInputText","id" => "notes", "cols" => 43, "rows" => 4)); ?>
                <div class="errorHolder below"></div>
            </div>
            <br class="clear" />
            <div class="formbuttons">
                <input type="button" class="savebutton" name="btnSave" id="btnSave"
                       value="<?php echo __("Submit"); ?>"onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
                    <input type="button" class="backbutton" name="btnBack" id="btnBack"
                           value="<?php echo __("Back"); ?>"onmouseover="moverButton(this);" onmouseout="moutButton(this);"/>
            </div>

        </form>
    </div>

<script type="text/javascript">
    //<![CDATA[
    var description	= '<?php $description; ?>';
    var vacancyId	= '<?php echo $vacancyId; ?>';
    var candidateId	= '<?php echo $candidateId; ?>';
    var lang_firstNameRequired = "<?php echo __("First name is required"); ?>";
    var lang_lastNameRequired = "<?php echo __("Last name is required"); ?>";
    var lang_emailRequired = "<?php echo __("E-mail is required"); ?>";
    var lang_validEmail = "<?php echo __("Email address should contain at least one '.' and one '@' Example:user@example.com"); ?>";
    var lang_tooLargeInput = "<?php echo __("Please enter no more than 30 characters"); ?>";
    var lang_commaSeparated = "<?php echo __("Enter comma separated words..."); ?>";
    var lang_validPhoneNo = "<?php echo __("Enter a valid contact number"); ?>";
    var lang_noMoreThan255 = "<?php echo __("Please enter no more than 255 characters"); ?>";
    var lang_resumeRequired = "<?php echo __("Please attach your resume"); ?>";
    var linkForApplyVacancy = "<?php echo url_for('recruitment/applyVacancy'); ?>";
    var lang_back = "<?php echo __("Go to Job Page")?>";
	
</script>