export default {
    directives: {
        /**
         * AutoFocus for inputs
         */
        focus: {
            inserted(el) {
                el.focus();
            },
        },
    },
}