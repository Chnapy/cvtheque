
/* global FORM */

window.onload = onLoad;

var GLOBALS = {
    form: FORM,
    hobby_index: -1,
    skill_index: -1,
    education_index: -1,
    work_index: -1
};

function onLoad() {

    function butClicked(but) {
        $(but).attr('disabled', true);
        $(but).addClass('load disabled');
    }

    $('.but:not([type="submit"]):not(.disabled)').click(e => butClicked(e.target));

    $('form').submit(e => {
        let form = e.target;
        if ($(form)[0].checkValidity()) {
            butClicked($(form).find('.but[type="submit"]'));
        }
    });

    initSkills();
    initHobby();
    initEducations();
    initWork();
}

//General

function applyDate(str_type, str_date, str_val, index) {
    if (!str_date) {
        return;
    }
    let d = new Date(str_date);

    $('#fos_user_' + GLOBALS.form + '_form_' + str_type + '_' + index + '_' + str_val + '_day option[value="' + d.getDate() + '"]').attr('selected', true);
    $('#fos_user_' + GLOBALS.form + '_form_' + str_type + '_' + index + '_' + str_val + '_month option[value="' + (d.getMonth() + 1) + '"]').attr('selected', true);
    $('#fos_user_' + GLOBALS.form + '_form_' + str_type + '_' + index + '_' + str_val + '_year option[value="' + d.getFullYear() + '"]').attr('selected', true);
}

function setItemDeletable(item) {
    $(item).find('.delete').click(e => $(e.target).parent().remove());
}

//Skills

function initSkills() {

    $('#ip_skills').keypress(e => {
        if (e.key !== 'Enter') {
            return;
        }
        e.preventDefault();

        let i = e.target;
        let val = i.value;
        if (!val || !i.checkValidity()) {
            return;
        }

        newSkill(val);
        e.target.value = '';
    });

    setItemDeletable('.skills-item');

    var skills = $('.skills').data('skills');

    if (skills) {
        skills.forEach(h => newSkill(h));
    }
}

function newSkill(value) {
    GLOBALS.skill_index++;
    let hobby = `<span class="skills-item tag deletable onhover">
		${value}<span class="delete mini-but glyphicon glyphicon-remove"></span>
		<input type="hidden" name="fos_user_${GLOBALS.form}_form[skills][${GLOBALS.skill_index}][name]" value="${value}"/>
	</span>`;

    $('.skills .skills-content .skills-add').after(hobby);

    setItemDeletable($('.skills .skills-content .skills-item').first());
}

//Hobbys

function initHobby() {

    $('#ip_hobbys').keypress(e => {
        if (e.key !== 'Enter') {
            return;
        }
        e.preventDefault();

        let i = e.target;
        let val = i.value;
        if (!val || !i.checkValidity()) {
            return;
        }

        newHobby(val);
        e.target.value = '';
    });

    setItemDeletable('.hobbys-item');

    var hobbys = $('.hobbys').data('hobbys');

    if (hobbys) {
        hobbys.forEach(h => newHobby(h));
    }
}

function newHobby(value) {
    GLOBALS.hobby_index++;
    let hobby = `<span class="hobbys-item tag deletable onhover">
		${value}<span class="delete mini-but glyphicon glyphicon-remove"></span>
		<input type="hidden" name="fos_user_${GLOBALS.form}_form[hobbies][${GLOBALS.hobby_index}][name]" value="${value}"/>
	</span>`;

    $('.hobbys .hobbys-content .hobbys-add').after(hobby);

    setItemDeletable($('.hobbys .hobbys-content .hobbys-item').first());
}

//Educations

function initEducations() {

    var educations = $('.educations').data('educations');

    if (educations) {
        educations.forEach(e => newEducation(e));
    }

    $('#educations-add').click(e => {
        e.preventDefault();
        $(e.target).attr('disabled', false);
        $(e.target).removeClass('load disabled');
        newEducation();
    });
}

function newEducation(array) {
    GLOBALS.education_index++;
    let p = "<div class='bloc educations-item'><span class='delete mini-but glyphicon glyphicon-remove'></span>" + $('.educations').data('prototype') + "</div>";
    p = p.replace(/__name__/g, GLOBALS.education_index);

    $('.educations .educations-content').append(p);
    
    setItemDeletable($('.educations .educations-content .educations-item').last());

    if (!array) {
        return;
    }

    if (array.school) {
        $('#fos_user_' + GLOBALS.form + '_form_educations_' + GLOBALS.education_index + '_school').val(array.school);
    }
    if (array.degree) {
        $('#fos_user_' + GLOBALS.form + '_form_educations_' + GLOBALS.education_index + '_degree').val(array.degree);
    }

    applyDate('educations', array.fromDate, 'fromDate', GLOBALS.education_index);
    applyDate('educations', array.toDate, 'toDate', GLOBALS.education_index);
}

//Works

function initWork() {

    var works = $('.works').data('works');

    if (works) {
        works.forEach(w => newWork(w));
    }

    $('#works-add').click(e => {
        e.preventDefault();
        $(e.target).attr('disabled', false);
        $(e.target).removeClass('load disabled');
        newWork();
    });

}

function newWork(array) {
    GLOBALS.work_index++;
    let p = "<div class='bloc works-item'><span class='delete mini-but glyphicon glyphicon-remove'></span>" + $('.works').data('prototype') + "</div>";
    p = p.replace(/__name__/g, GLOBALS.work_index);

    $('.works .works-content').append(p);
    
    setItemDeletable($('.works .works-content .works-item').last());

    if (!array) {
        return;
    }

    if (array.jobTitle) {
        $('#fos_user_' + GLOBALS.form + '_form_workExperiences_' + GLOBALS.work_index + '_jobTitle').val(array.jobTitle);
    }
    if (array.employer) {
        $('#fos_user_' + GLOBALS.form + '_form_workExperiences_' + GLOBALS.work_index + '_employer').val(array.employer);
    }
    if (array.description) {
        $('#fos_user_' + GLOBALS.form + '_form_workExperiences_' + GLOBALS.work_index + '_description').val(array.description);
    }

    applyDate('workExperiences', array.fromDate, 'fromDate', GLOBALS.work_index);
    applyDate('workExperiences', array.toDate, 'toDate', GLOBALS.work_index);
}