// script for profile
module.exports = function (data) {
    var _data = {
        editing: false,
        input: {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            profile: {
                phone_number: '',
                mobile_number: '',
                address: '',
                city: '',
                state: '',
                zip: '',
            }
        }
    };
    return {
        data: (() => Object.assign({}, data, _data)),
        created() {
            var vm = this;
            vm.input.name = vm.current.name;
            vm.input.email = vm.current.email;
            if (vm.current.profile)
                vm.input.profile = vm.current.profile;
        },
        mounted() {
            this.init();            
        },
        computed: {
            EditClass() {
                return {
                    'text-primary': !this.editing,
                    'text-info': this.editing
                }
            }
        },
        methods: {
            init() {
            },

            toggleEdit() {
                this.editing = !this.editing;
            },

            updateProfile() {
                var vm = this;
                var data = Object.assign({}, { _method: 'PATCH'}, vm.input);
                axios({
                    method: 'POST',
                    url: '/ajax/profile/'+vm.input.id,
                    data
                })
                .then(function (response) {
                    if (response.status === 200) {
                        vm.toggleEdit();
                    }
                });
            }
        }
    }
}
