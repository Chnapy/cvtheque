
/* global FORM, FORM_NAME */

window.onload = onLoad;

var GLOBALS = {
    education_index: -1,
    work_index: -1
};

function onLoad() {
    try {
        GLOBALS.form = FORM;
    } catch (e) {
    }

    bugFixes();

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

    if (GLOBALS.form) {
        initSkills();
//        initHobby();
    }

    initEducations();
    initWork();
}

//Corrige les bugs recensés non corrigés de PHP

function bugFixes() {
    $('.field>input[type="hidden"]').parent().hide();
}

//General

function applyDate(str_type, str_date, str_val, index) {
    if (!str_date) {
        return;
    }
    let d = new Date(str_date);

    $('#' + GLOBALS.form + '_' + str_type + '_' + index + '_' + str_val + '_day option[value="' + d.getDate() + '"]').attr('selected', true);
    $('#' + GLOBALS.form + '_' + str_type + '_' + index + '_' + str_val + '_month option[value="' + (d.getMonth() + 1) + '"]').attr('selected', true);
    $('#' + GLOBALS.form + '_' + str_type + '_' + index + '_' + str_val + '_year option[value="' + d.getFullYear() + '"]').attr('selected', true);
}

function setItemDeletable(item) {
    $(item).find('.delete').click(e => $(e.target).parent().remove());
}

//Skills

function initSkills() {

    $('.skills').each((i, element) => {
        var name = $(element).data('name');
        var supp = $(element).data('supp');
        if (!name) {
            alert('Champ skill: name non défini');
        }

        $(element).data('index', -1);

        $(element).find('#ip_skills').keypress(e => {
            if (e.key !== 'Enter') {
                return;
            }
            e.preventDefault();

            let i = e.target;
            let val = i.value;
            if (!val || !i.checkValidity()) {
                return;
            }

            newSkill(element, val, name, supp);
            e.target.value = '';
        });

        setItemDeletable($(element).find('.skills-item'));

        var skills = $(element).data('skills');

        if (skills) {
            skills.forEach(h => newSkill(element, h, name, supp));
        }

    });
}

function newSkill(element, value, name, supp) {
    let index = $(element).data('index') + 1;
    $(element).data('index', index);

    let hobby = `<span class="skills-item tag deletable onhover">
		${value}<button class="delete mini-but glyphicon glyphicon-remove"><span class="sr-only sr-only-focusable">${supp}</span></button>
		<input type="hidden" name="${GLOBALS.form}[${name}][${index}][name]" value="${value}"/>
	</span>`;

    $(element).find('.skills-content .skills-add').after(hobby);

    setItemDeletable($(element).find('.skills-content .skills-item').first());
}

//Hobbys
//
//function initHobby() {
//
//    $('#ip_hobbys').keypress(e => {
//        if (e.key !== 'Enter') {
//            return;
//        }
//        e.preventDefault();
//
//        let i = e.target;
//        let val = i.value;
//        if (!val || !i.checkValidity()) {
//            return;
//        }
//
//        newHobby(val);
//        e.target.value = '';
//    });
//
//    setItemDeletable('.hobbys-item');
//
//    var hobbys = $('.hobbys').data('hobbys');
//
//    if (hobbys) {
//        hobbys.forEach(h => newHobby(h));
//    }
//}
//
//function newHobby(value) {
//    GLOBALS.hobby_index++;
//    let hobby = `<span class="hobbys-item tag deletable onhover">
//		${value}<button class="delete mini-but glyphicon glyphicon-remove"><span class="sr-only sr-only-focusable">Supprimer le passe-temps</span></button>
//		<input type="hidden" name="${GLOBALS.form}[hobbies][${GLOBALS.hobby_index}][name]" value="${value}"/>
//	</span>`;
//
//    $('.hobbys .hobbys-content .hobbys-add').after(hobby);
//
//    setItemDeletable($('.hobbys .hobbys-content .hobbys-item').first());
//}

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
    let p = "<div class='bloc educations-item'><button class='delete mini-but glyphicon glyphicon-remove'>\n\
        <span class='sr-only sr-only-focusable'>Supprimer la formation</span>\n\
        </button>" + $('.educations').data('prototype') + "</div>";
    p = p.replace(/__name__/g, GLOBALS.education_index);

    $('.educations .educations-content').append(p);

    setItemDeletable($('.educations .educations-content .educations-item').last());

    if (!array) {
        return;
    }

    if (array.school) {
        $('#' + GLOBALS.form + '_educations_' + GLOBALS.education_index + '_school').val(array.school);
    }
    if (array.degree) {
        $('#' + GLOBALS.form + '_educations_' + GLOBALS.education_index + '_degree').val(array.degree);
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
    let p = "<div class='bloc works-item'><button class='delete mini-but glyphicon glyphicon-remove'>\n\
            <span class='sr-only sr-only-focusable'>Supprimer l'expérience professionnelle</span>\n\
            </button>" + $('.works').data('prototype') + "</div>";
    p = p.replace(/__name__/g, GLOBALS.work_index);

    $('.works .works-content').append(p);

    setItemDeletable($('.works .works-content .works-item').last());

    if (!array) {
        return;
    }

    if (array.jobTitle) {
        $('#' + GLOBALS.form + '_workExperiences_' + GLOBALS.work_index + '_jobTitle').val(array.jobTitle);
    }
    if (array.employer) {
        $('#' + GLOBALS.form + '_workExperiences_' + GLOBALS.work_index + '_employer').val(array.employer);
    }
    if (array.description) {
        $('#' + GLOBALS.form + '_workExperiences_' + GLOBALS.work_index + '_description').val(array.description);
    }

    applyDate('workExperiences', array.fromDate, 'fromDate', GLOBALS.work_index);
    applyDate('workExperiences', array.toDate, 'toDate', GLOBALS.work_index);
}