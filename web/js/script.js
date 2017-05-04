
/* global FORM, FORM_NAME */

var GLOBALS = {
    education_index: -1,
    work_index: -1,
    skill_id_index: -1,
    skill_data: undefined, //Données ajax
    skill_names: ['skills', 'advertSkills']
};

var SKILLS_URL = '/app.php/api/skills';

window.onload = onLoad;

function onLoad() {
    try {
        GLOBALS.form = FORM;
    } catch (e) {
    }

    bugFixes();
    fixFooter();

    function butClicked(but) {
        $(but).attr('disabled', true);
        $(but).addClass('load disabled');
    }

    $('.but:not([type="submit"]):not(.disabled):not([target="_blank"])').click(e => butClicked(e.target));

    $('form').submit(e => {
        let form = e.target;
        if ($(form)[0].checkValidity()) {
            butClicked($(form).find('.but[type="submit"]'));
        }
    });

    if (GLOBALS.form) {
        initSkills();
    }

    initEducations();
    initWork();

    minorFixes();

    $('[data-toggle="tooltip"]').each((i, e) => {
        if ($(e).is('input')) {
            let type = $(e).attr('type');
            if (type === 'text' || type === 'email' || type === 'password') {
                $(e).tooltip({trigger: 'focus'});
            }
        }
        $(e).tooltip();
    });
}

function stopEvent(e) {
    if (e.preventDefault) {
        e.preventDefault();
    } else {
        e.returnValue = false;
    }
    e.stopPropagation();
}

function fixFooter() {
    let footHeight = $('#footer')[0].clientHeight;
    $('.main-content').css('padding-bottom', footHeight + 'px');
    $('#footer').css('opacity', 1);
}

//Corrige les bugs recensés non corrigés de PHP

function bugFixes() {
    $('.field>input[type="hidden"]').parent().hide();
    $('input[type="password"]').each((i, element) => {
        element.onpaste = (e) => stopEvent(e);
    });
}

//Réglages mineurs

function minorFixes() {
    if (!$('select option[selected]').length) {
        $('select option[value="FR"]').attr('selected', true);
    }

    $('header .compte').click(function (e) {
        if ($(e.target).is('.deco') || $(e.target).parents('.deco').length) {
            return;
        }
        if (!$(e.target).is('.compte-pseudo')) {
            $(this).find('.compte-pseudo')[0].click();
        }
    });
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

    getSkillData();

    $('.skills').each((i, element) => {
        var name = $(element).data('name');
        var supp = $(element).data('supp');
        if (!name) {
            console.error('Champ skill: name non défini');
        }

        $(element).data('index', -1);

        $(element).find('.skills-add').after('<button class="but but_skills"><span class="sr-only sr-only-focusable">Ajouter</span><span class="glyphicon glyphicon-plus"></span></button>');

        function onValid(e, inp) {
            stopEvent(e);

            let val = inp.value;
            if (!val || !inp.checkValidity()) {
                inp.focus();
                return;
            }

            newSkill(element, val, name, supp);
            inp.value = '';
            inp.focus();
        }

        var input = $(element).find('.ip_skills')[0];

        //tooltip bootstrap
        $(input).tooltip({
            toggle: 'tooltip',
            placement: 'top',
            title: 'Appuyez sur entrée pour ajouter la valeur',
            trigger: 'focus'
        });

        $(element).find('.skills-content').addClass('but-group');

        $(element).find('.but_skills').click(e => onValid(e, input));

        $(input).keypress(e => {
            if (e.key !== 'Enter') {
                return;
            }

            let inp = e.target;
            onValid(e, inp);

            return false;
        });

        setItemDeletable($(element).find('.skills-item'));

        var skills = $(element).data('skills');

        if (skills) {
            skills.forEach(h => newSkill(element, h, name, supp));
        }

    });
}

function getSkillData() {
    $.get(SKILLS_URL, {}, (data) => {
        GLOBALS.skill_data = data;

        $('.skills').each((i, element) => {
            var name = $(element).data('name');
            if (GLOBALS.skill_names.indexOf(name) === -1) {
                return;
            }

            GLOBALS.skill_id_index++;
            let list_id = GLOBALS.skill_id_index;

            let list = 'list' + list_id;
            let list_sel = list + '_select';

            let datalist = `<datalist id="${list}">
                        <label for="${list_sel}">ou sélectionner dans la liste</label>
                        <select id="${list_sel}">
                            ${data.map(d => `<option value="${d.name}">${d.name}</option>`).join('')}
                        </select>
                    </datalist>`;

            let input = $(element).find('.ip_skills');
            $(input).attr('list', list);
            $(input).parent().append(datalist);
        });
    });
}

function newSkill(element, value, name, supp) {
    let index = $(element).data('index') + 1;
    $(element).data('index', index);

    function skillIndex(name) {
        if (!GLOBALS.skill_data) {
            return -1;
        }
        for (var i = 0; i < GLOBALS.skill_data.length; i++) {
            if (GLOBALS.skill_data[i].name === name) {
                return i;
            }
        }
        return -1;
    }

    var id_html;
    if (GLOBALS.skill_names.indexOf(name) > -1 && skillIndex(value) > -1) {
        let id = GLOBALS.skill_data[skillIndex(value)].id;
        id_html = `<input type="hidden" name="${GLOBALS.form}[${name}][${index}][id]" value="${id}"/>`;
    } else {
        id_html = '';
    }

    let hobby = `<span class="skills-item tag deletable onhover">
		${value}<button class="delete mini-but glyphicon glyphicon-remove"><span class="sr-only sr-only-focusable">${supp}</span></button>
		${id_html}
		<input type="hidden" name="${GLOBALS.form}[${name}][${index}][name]" value="${value}"/>
	</span>`;

    $(element).find('.skills-content .but_skills').after(hobby);

    setItemDeletable($(element).find('.skills-content .skills-item').first());
}

//Educations

function initEducations() {

    var educations = $('.educations').data('educations');

    if (educations) {
        educations.forEach(e => newEducation(e));
    }

    $('#educations-add').click(e => {
        stopEvent(e);
        $(e.target).attr('disabled', false);
        $(e.target).removeClass('load disabled');
        newEducation();
        return false;
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
        stopEvent(e);
        $(e.target).attr('disabled', false);
        $(e.target).removeClass('load disabled');
        newWork();
        return false;
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
