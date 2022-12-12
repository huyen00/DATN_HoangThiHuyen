export default {
    methods: {
        search() {
            this.$inertia.get(
                this.route("tour.pano.index", this.tour.id), { term: this.term }, {
                    preserveState: true
                }
            );
        },
        reset: function() {
            this.form = this.$inertia.form({
                id: null,
                name: null,
                thumb: null,
                category: null
            });
            this.thumb = null;
        },
        edit(data) {
            this.editMode = true;
            this.form.id = data.id;
            this.form.name = data.name;
            this.form.category = data.category_pano_id;
            this.editMode = true;
            $('#exampleModal').on('shown.bs.modal', function() {
                $('#recipient-name').focus()
            });
        },
        cloesModal() {
            this.reset();
        }
    },
}