// script for login
module.exports = function (data) {
    var _data = {
    };
    return {
        data: (() => Object.assign({}, data, _data)),
        mounted() {
            this.init();            
        },
        methods: {
            init() {
                var vm = this;
                $(document).ready(function() {
                });
            },
        }
    }
}
