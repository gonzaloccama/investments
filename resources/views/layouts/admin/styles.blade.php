<style>
    /*** selection custom colors ***/
    ::selection {
        color: #a9a9a9;
        background: #3c3e45;
    }

    /*** form validations ***/
    .error-validate .form-control {
        border-color: #e52c18 !important;
    }

    .error-validate span {
        color: #e52c18 !important;
    }

    /*** fill forms ***/
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-transition: color 9999s ease-out, background-color 9999s ease-out;
        -webkit-transition-delay: 9999s;
    }

    input:-webkit-autofill {
        -webkit-background-clip: text;
    }

    /*** radio checks ***/
    .radio-box {
        width: 700px;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .radio-box input[type="radio"] {
        display: none
    }

    .radio-box input[type="radio"] + label {
        width: 150px;
        display: inline-block;
        text-align: center;
        cursor: pointer;
        user-select: none;
    }


    /* - - - radio 01 - - - */
    .radio-box input[type="radio"] + label {
        transition: all 200ms cubic-bezier(.4, .25, .3, 1);
        padding: 10px 0;
        color: #1D477A;
        background-color: rgba(29, 71, 122, 0.08);
        border: 2px solid #1D477A;
        font-weight: 800;
        border-radius: 50px;
    }

    .radio-box input[type="radio"] + label:hover {
        opacity: .65
    }


    .radio-box input[type="radio"] + label:active {
        transition: none;
        transform: scale(.925);
    }

    .radio-box input[type="radio"]:checked + label,
    .radio-box input[type="radio"]:checked + label:hover {
        background-color: #1D477A;
        color: #fff;
        opacity: 1;
        font-weight: bold;
    }

    /******/
    .radio-button {
        position: relative !important;
        border: solid 4px #1D477A !important;
        border-radius: 55px !important;
        transition: transform cubic-bezier(0, 0, 0.30, 2) .4s !important;
        transform-style: preserve-3d !important;
        perspective: 800px !important;
        width: 100% !important;
        height: 40px;
        background-color: white;
        /*box-shadow: 0 0 2px 0 rgba(159, 159, 159, 0.32);*/
    }

    .radio-button > input[type="radio"] {
        display: none !important;
    }

    .radio-button > #one:checked ~ #flap {
        transform: rotateY(-180deg) !important;
    }

    .radio-button > #one:checked ~ #flap > .content {
        transform: rotateY(-180deg) !important;
    }

    .radio-button > #two:checked ~ #flap {
        transform: rotateY(0deg) !important;
    }

    .radio-button > label {
        margin-top: 2px;
        /*display: r !important;*/
        /*min-width: 170px !important;*/
        width: 45%;
        padding: 4px !important;
        font-size: 14px !important;
        text-align: center !important;
        color: #1D477A !important;
        cursor: pointer !important;
    }

    .radio-button > label,
    .radio-button > #flap {
        font-weight: bold !important;
        text-transform: capitalize !important;
    }

    .radio-button > #flap {
        position: absolute !important;
        top: -4px !important;
        /*top: calc(0px - 6px) !important;*/
        left: 50% !important;
        height: 40px !important;
        /*height: calc(100% + 6px * 2) !important;*/
        width: 51% !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        font-size: 14px !important;
        background-color: #1D477A !important;
        border-top-right-radius: 55px !important;
        border-bottom-right-radius: 55px !important;
        transform-style: preserve-3d !important;
        transform-origin: left !important;
        transition: transform cubic-bezier(0.4, 0, 0.2, 1) .5s !important;
    }

    .radio-button > #flap > .content {
        color: #ffffff !important;
        transition: transform 0s linear .25s !important;
        transform-style: preserve-3d !important;
    }

    /******/

    .radio-check {
        width: 100%;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: space-evenly;
    }

    .radio-check .option {
        background: #d4d3d3;
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        cursor: pointer;
        border-radius: 30px;
        border: 3px solid #153459;
        transition: all 0.5s ease;
        margin: 0 2px;
        color: #1b1e21;
    }

    input[type="radio"] {
        display: none;
    }

    input#one:checked ~ .option-1,
    input#two:checked ~ .option-2 {
        background: #153459;
        border-color: #153459;
    }

    input#one:checked ~ .option-1 span,
    input#two:checked ~ .option-2 span {
        color: #fff;
    }

    .radio-check .option span {
        font-size: 14px;
    }

    /*** scroll ***/
    .scrollbar {
        overflow-y: auto;
    }

    ._scroller::-webkit-scrollbar {
        border-radius: 10px;
        width: 10px;
        height: 10px;
        background-color: #ddd;
    }

    ._scroller::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        /*background-color: rgba(221, 221, 221, 0.65);*/
        border-radius: 10px;
    }

    ._scroller::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #1D477A;
    }

    .scroller::-webkit-scrollbar {
        border-radius: 10px;
        width: 5px;
        height: 5px;
        background-color: #ddd;
    }

    .scroller::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        /*background-color: rgba(221, 221, 221, 0.65);*/
        border-radius: 10px;
    }

    .scroller::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #53575a;
    }


    /*._scroller::-webkit-scrollbar-thumb:hover {*/
    /*    border-radius: 10px;*/
    /*    background-color: #00365A;*/
    /*}*/


    /*** table show data ***/
    #table-user tr th {
        text-transform: uppercase;
        font-weight: bolder;
    }

    #form-user label {
        text-transform: uppercase;
    }

    /*** table custom ***/

    .table-hover tbody tr:hover {
        color: #585858;
    }

    /*begin select2*/

    .select2-container--material {
        width: 100% !important;
    }

    .select2-container--material .select2-selection--single {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #ced4da;
        border-radius: 0;
        box-shadow: none;
        box-sizing: content-box;
        height: auto;
        margin: 0;
        outline: none;
        padding: 8px 0 5px 0;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .select2-container--material .select2-selection--single .select2-selection__rendered {
        color: #929292;
        line-height: 28px;
        padding-left: 10px;
    }

    .select2-container--material .select2-selection--single .select2-selection__clear {
        cursor: pointer;
        float: right;
        font-weight: bold;
    }

    .select2-container--material .select2-selection--single .select2-selection__placeholder {
        color: #484848;
    }

    .select2-container--material .select2-selection--single .select2-selection__arrow {
        height: 26px;
        margin: 0.6rem 0 0.4rem 0;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }

    .select2-container--material .select2-selection--single .select2-selection__arrow b {
        border-color: #888 transparent transparent transparent;
        border-style: solid;
        border-width: 5px 4px 0 4px;
        height: 0;
        left: 50%;
        margin-left: -4px;
        margin-top: -2px;
        position: absolute;
        top: 50%;
        width: 0;
    }

    .select2-container--material[dir="rtl"] .select2-selection--single .select2-selection__clear {
        float: left;
    }

    .select2-container--material[dir="rtl"] .select2-selection--single .select2-selection__arrow {
        left: 1px;
        right: auto;
    }

    .select2-container--material.select2-container--disabled .select2-selection--single {
        background-color: #eee;
        cursor: default;
    }

    .select2-container--material.select2-container--disabled .select2-selection--single .select2-selection__clear {
        display: none;
    }

    .select2-container--material.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #888 transparent;
        border-width: 0 4px 5px 4px;
    }

    .select2-container--material .select2-selection--multiple {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #ced4da;
        border-radius: 0;
        box-shadow: none;
        box-sizing: content-box;
        cursor: text;
        height: auto;
        margin: 0;
        outline: none;
        padding: 5px 0 0 0;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .select2-search__field {
        color: #8d8d8d;
    }

    .select2-selection.select2-selection--multiple.form-control {
        caret-color: #8d8d8d;
        padding-left: 5px;
    }

    .select2-container--material .select2-selection--multiple .select2-selection__rendered {
        box-sizing: border-box;
        list-style: none;
        margin: 0;
        padding: 5px;
        width: 100%;
    }

    .select2-container--material .select2-selection--multiple .select2-selection__rendered li {
        list-style: none;
    }

    .select2-container--material .select2-selection--multiple .select2-selection__placeholder {
        color: #868585;
        margin-top: 5px;
        float: left;
    }

    .select2-container--material .select2-selection--multiple .select2-selection__clear {
        cursor: pointer;
        float: right;
        font-weight: bold;
        margin-top: 5px;
        margin-right: 10px;
    }

    .select2-container--material .select2-selection--multiple .select2-selection__choice {
        background-color: #1D477A;
        border-radius: 5px;
        color: rgba(252, 252, 252, 0.96);
        cursor: auto;
        float: left;
        margin-right: 5px;
        /*margin-top: 6px;*/
        padding: 8px 12px;
    }

    .select2-container--material .select2-selection--multiple .select2-selection__choice__remove {
        cursor: pointer;
        display: inline-block;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .select2-container--material .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #f66262;
    }

    .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-selection__choice, .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-selection__placeholder, .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-search--inline {
        float: right;
    }

    .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
        margin-left: 5px;
        margin-right: auto;
    }

    .select2-container--material[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
        margin-left: 2px;
        margin-right: auto;
    }

    .select2-container--material.select2-container--disabled .select2-selection--multiple {
        background-color: #eee;
        cursor: default;
    }

    .select2-container--material.select2-container--disabled .select2-selection__choice__remove {
        display: none;
    }

    .select2-container--material.select2-container--open.select2-container--above .select2-selection--single, .select2-container--material.select2-container--open.select2-container--above .select2-selection--multiple {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .select2-container--material.select2-container--open.select2-container--below .select2-selection--single, .select2-container--material.select2-container--open.select2-container--below .select2-selection--multiple {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .select2-container--material.select2-container--focus .select2-selection--single {
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        outline: 0;
    }

    .select2-container--material.select2-container--focus .select2-selection--multiple {
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        outline: 0;
    }

    .select2-container--material .select2-search--dropdown .select2-search__field {
        border: 1px solid #828385;
        /*border-bottom: ;*/
        /*border-top: 1px solid #828385;*/
        border-radius: 15px;
        outline: none;
    }

    .select2-container--material .select2-search--dropdown .select2-search__field:focus:not([readonly]) {
        box-shadow: 0 1px 0 0 #a0a6ac;
        border-bottom: 1px solid #a3aab1;
    }

    .select2-container--material .select2-search--inline .select2-search__field {
        background: transparent;
        border: none !important;
        outline: 0;
        box-shadow: none !important;
        -webkit-appearance: textfield;
    }

    /** select scroll **/
    .select2-container--material .select2-results > .select2-results__options {
        max-height: 200px;
        overflow-y: auto;
    }

    .select2-container--material .select2-results > .select2-results__options::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #b0b0b0;
        border-radius: 10px;
    }

    .select2-container--material .select2-results > .select2-results__options::-webkit-scrollbar {
        border-radius: 10px;
        width: 5px;
        height: 5px;
        background-color: #b0b0b0;
    }

    .select2-container--material .select2-results > .select2-results__options::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #53575a;
    }

    .select2-container--material .select2-results__option[role=group] {
        padding: 0;
    }

    .select2-container--material .select2-results__option[aria-disabled=true] {
        color: #212121 !important;
    }

    .select2-container--material .select2-results__option[aria-selected=true] {
        background-color: #ddd;
    }

    .select2-container--material .select2-results__option .select2-results__option {
        padding-left: 1em;
    }

    .select2-container--material .select2-results__option .select2-results__option .select2-results__group {
        padding-left: 0;
    }

    .select2-container--material .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -1em;
        padding-left: 2em;
    }

    .select2-container--material .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -2em;
        padding-left: 3em;
    }

    .select2-container--material .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -3em;
        padding-left: 4em;
    }

    .select2-container--material .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -4em;
        padding-left: 5em;
    }

    .select2-container--material .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
        margin-left: -5em;
        padding-left: 6em;
    }

    .select2-container--material .select2-results__option--highlighted[aria-selected] {
        background-color: #00365A;
        color: white;
    }

    .select2-container--material .select2-results__group {
        cursor: default;
        display: block;
        padding: 6px;
    }

    .select2-dropdown {
        background-color: white;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        display: block;
        position: absolute;
        left: -100000px;
        width: 100%;
        z-index: 1051;
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
    }

    .select2-results {
        display: block;
    }

    .select2-results__options {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .select2-results__option {
        padding: 6px;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-results__option[aria-selected] {
        cursor: pointer;
    }

    .select2-container--open .select2-dropdown {
        left: 0;
    }

    .select2-container--open .select2-dropdown--above {
        padding: 8px 10px 10px !important;
        /*border-bottom-left-radius: 0;*/
        /*border-bottom-right-radius: 0;*/
        border-radius: 0px !important;
    }

    .select2-container--open .select2-dropdown--below {
        padding: 8px 10px 10px !important;
        /*border-top-left-radius: 0;*/
        /*border-top-right-radius: 0;*/
        border-radius: 0px !important;
    }

    .select2-search--dropdown {
        display: block;
        padding: 5px 0 8px 0;
    }

    .select2-search--dropdown .select2-search__field {
        padding: 5px 15px 5px 15px;
        width: 100%;
        box-sizing: border-box;
    }

    .select2-search--dropdown .select2-search__field::-webkit-search-cancel-button {
        -webkit-appearance: none;
    }

    .select2-search--dropdown.select2-search--hide {
        display: none;
    }

    .select2-results__option {
        color: #072239;
        opacity: 1;
    }


    .select2-container--bootstrap .select2-results > .select2-results__options::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(169, 169, 169, 0.3);
        background-color: #b0b0b0;
        border-radius: 10px;
    }

    .select2-container--bootstrap .select2-results > .select2-results__options::-webkit-scrollbar {
        border-radius: 10px;
        width: 5px;
        height: 5px;
        background-color: #b0b0b0;
    }

    .select2-container--bootstrap .select2-results > .select2-results__options::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #53575a;
    }

    /*begin select2*/


    /*** CKeditor 5 ***/

    .ck.ck-editor__main .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-focused.ck-editor__editable_inline::-webkit-scrollbar-track,
    .ck.ck-editor__main .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-blurred.ck-editor__editable_inline::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #b0b0b0;
        border-radius: 10px;
    }

    .ck.ck-editor__main .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-focused.ck-editor__editable_inline::-webkit-scrollbar,
    .ck.ck-editor__main .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-blurred.ck-editor__editable_inline::-webkit-scrollbar {
        border-radius: 10px;
        width: 5px;
        height: 5px;
        background-color: #b0b0b0;
    }

    .ck.ck-editor__main .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-focused.ck-editor__editable_inline::-webkit-scrollbar-thumb,
    .ck.ck-editor__main .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-blurred.ck-editor__editable_inline::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #53575a;
    }

    .ck.ck-editor__main,
    .ck.ck-editor__main .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-focused.ck-editor__editable_inline,
    .ck.ck-editor__main .ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-blurred.ck-editor__editable_inline {
        min-height: 120px !important;
        max-height: 200px !important;
    }

    .ck.ck-button.ck-off {
        color: #737373 !important;
    }

    .ck.ck-button.ck-off:hover {
        color: #1D477A !important;
    }

    /*.border {*/
    /*    border:1px solid rgba(66, 66, 66, 0.4) !important;*/
    /*}*/

    /*** progress bar ***/
    /*.progress-custom {*/
    /*    height: 25px;*/
    /*    width: 120px;*/
    /*    border-radius: 25px;*/
    /*    text-shadow: 0 0 5px #1d1e22, 0 0 5px #0d0f10;*/
    /*    font-weight: 300;*/
    /*    font-size: 10px;*/
    /*}*/

    .progress-outer {
        background: rgba(255, 255, 255, 0.02);
        padding: 3px 48px 3px 3px;
        border: 1px solid #bebfbf;
        border-radius: 45px;
        margin-bottom: 20px;
        position: relative;
        width: 170px;
        top: 10px;
        box-shadow: 0 0 1px 0 rgba(169, 169, 169, 0.68);
    }

    .progress {
        background: rgba(190, 191, 191, 0.86);
        border-radius: 20px;
        margin: 0;
        height: 18px;
    }

    .progress .progress-bar {
        border-radius: 20px;
        box-shadow: none;
        animation: animate-positive 2s;
    }

    .progress .progress-value {
        font-size: 11px;
        font-weight: bold;
        color: #222528;
        position: absolute;
        top: 13px;
        right: 5px;
    }

    .progress-bar {
        animation: reverse progress-bar-stripes 0.40s linear infinite, animate-positive 2s !important;
    }

    @keyframes animate-positive {
        0% {
            width: 0;
        }
    }

    /*** status badge ***/
    .badge {
        padding: 6px 8px 6px 8px;
        margin: 0;
        border-radius: 25px !important;
        font-size: 11px;
    }

    .badge-success-1 {
        border: 1px dashed #157045;
        background-color: rgba(10, 52, 32, 0.15);
        color: #157045;
    }

    .badge-danger-1 {
        border: 1px dashed #f63c44;
        background-color: rgba(246, 60, 68, 0.08);
        color: #f63c44;
    }


    .badge-inactive {
        border: 1px dashed #fc751c;
        background-color: rgba(252, 117, 28, 0.10);
        color: #fc751c;
    }

    .badge-active {
        border: 1px dashed #1D477A;
        background-color: rgba(29, 71, 122, 0.10);
        color: #1D477A;
    }

    .badge-canceled {
        border: 1px dashed #e70606;
        background-color: rgba(231, 6, 6, 0.08);
        color: #e70606;
    }

    .badge-completed {
        border: 1px dashed #328359;
        background-color: rgba(10, 52, 32, 0.10);
        color: #328359;
    }

    .badge-paid {
        border: 1px dashed #328359;
        background-color: rgba(10, 52, 32, 0.10);
        color: #328359;
    }

    .badge-waiting {
        border: 1px dashed #1D477A;
        background-color: rgba(29, 71, 122, 0.10);
        color: #1D477A;
    }

    .badge-pending {
        border: 1px dashed #fc751c;
        background-color: rgba(252, 117, 28, 0.10);
        color: #fc751c;
    }

    /*** noViSlider ***/
    .slider.noUi-target.noUi-ltr.noUi-horizontal {
        /*height: 10px !important;*/
        border-color: rgba(255, 255, 255, 0) !important;
        border-radius: 50px !important;
        background-color: rgba(255, 255, 255, 0) !important;
        margin: 0 38px 0 3px !important;
        box-shadow: none !important;
    }

    /*.noUi-handle.noUi-handle-lower {*/
    /*    margin-top: -4px !important;*/
    /*    border: none !important;*/
    /*    background-color: #1D477A;*/
    /*    width: 32px !important;*/
    /*    height: 26px !important;*/
    /*    box-shadow: 0 0 2px 0 rgba(152, 152, 152, 0.79) !important;*/
    /*}*/

    /*.noUi-tooltip {*/
    /*    height: 28px !important;*/
    /*    color: #1D477A !important;*/
    /*    font-weight: 700 !important;*/
    /*}*/

    .noUi-target {
        height: 15px;
        border: none;
        margin: 40px 0 0 0;
    }

    .noUi-target .noUi-base {
        background: linear-gradient(117deg, #1D477A 0, #4686d6 100%);
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .noUi-target .noUi-base .noUi-connect {
        background: #1D477A;
    }

    .noUi-target .noUi-base .noUi-tooltip {
        bottom: -35px;
        color: #1D477A;
        border: none;
        outline: none;
        font-weight: bold;
    }

    .noUi-handle.noUi-handle-lower {
        background: #1D477A;
        border-radius: 20px;
        width: 30px;
        height: 30px;
        outline: none;
        right: 0px;
        top: -8px;
        cursor: pointer;
        box-shadow: none;
        border: 3px solid #ffffff;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .noUi-handle.noUi-handle-lower.noUi-active {
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -o-transform: scale(1.2);
        -ms-transform: scale(1.2);
        transform: scale(1.2);
    }

    .noUi-handle.noUi-handle-lower::before, .noUi-handle.noUi-handle-lower::after {
        display: none;
    }

    .noUi-handle.noUi-handle-lower .noUi-touch-area {
        width: 30px;
        height: 30px;
    }

    /*** title nowrap ***/
    .title-nowrap {
        max-width: 70%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .title-1-nowrap {
        max-width: 85%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /*** avatar team custom ***/
    .team {
        font-size: 1rem;
        display: inline-block;
        width: 48px !important;
        height: 48px !important;
        border-radius: 50%;
        border: 3px solid rgba(29, 71, 122, 0.51) !important;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 2px 0 rgba(29, 71, 122, 0.81) !important;
    }

    .team img {
        width: 100%;
        border-radius: 50%;
        padding: 1px;
        box-shadow: 0 0 2px 0 rgba(29, 71, 122, 0.81) !important;
    }

    .team-sm {
        font-size: .875rem;
        width: 30px;
        height: 30px;
    }

    .team-group .team {
        position: relative;
        z-index: 2;
        border: 1px dashed rgba(6, 53, 84, 0.34);
    }

    .team-group .team:hover {
        z-index: 3;
    }

    .team-group .team + .team {
        margin-left: -1.4rem;
    }

    /*** nav ***/
    .nav-tabs .nav-item.show .nav-link::before, .nav-tabs .nav-link.active::before {
        width: 100% !important;
    }

    .nav-item .nav-link.active {
        background-color: rgba(29, 71, 122, 0.08) !important;
    }

    /*** nav tabs nowrap ***/
    .nav-nowrap {
        white-space: nowrap;
        display: block !important;
        flex-wrap: nowrap;
        max-width: 100%;
        overflow-x: scroll;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch
    }

    .nav-nowrap li {
        display: inline-block
    }

    .text-pending {
        color: #fc751c !important;
    }

    .text-paid {
        color: #328359 !important;
    }

    /*** fonts ***/
    .font-10 {
        font-size: 10px !important;
    }


    .font-11 {
        font-size: 11px !important;
    }

    .font-12 {
        font-size: 12px !important;
    }

    .font-13 {
        font-size: 13px !important;
    }

    .font-14 {
        font-size: 14px !important;
    }

    .font-15 {
        font-size: 15px !important;
    }

    .font-16 {
        font-size: 16px !important;
    }

    .font-17 {
        font-size: 17px !important;
    }

    .font-18 {
        font-size: 18px !important;
    }

    .font-19 {
        font-size: 19px !important;
    }

    .font-20 {
        font-size: 20px !important;
    }

    .font-21 {
        font-size: 21px !important;
    }

    .font-22 {
        font-size: 22px !important;
    }

    .font-24 {
        font-size: 24px !important;
    }

    .font-26 {
        font-size: 26px !important;
    }

    .font-28 {
        font-size: 28px !important;
    }

    .hover-list:hover {
        background-color: rgba(103, 103, 103, 0.4) !important;
    }

    .btn-success {
        background-color: #117e1c;
    }
</style>
