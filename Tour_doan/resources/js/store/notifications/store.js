export default {
    state() {
        return {
            notifications: [{
                    id: 1,
                    title: 'Birthday Reminder',
                    body: 'Today is Brians birthday.',
                    createdAt: 'just now',
                    readAt: null
                },
                {
                    id: 2,
                    title: 'Bank Holiday in London',
                    body: 'Our office in London has a bank holiday today. Do not expect them to answer the phone.',
                    createdAt: '4 hours ago',
                    readAt: null
                },
                {
                    id: 3,
                    title: 'Birthday Reminder',
                    body: 'Today is Christians birthday.',
                    createdAt: '27 days ago',
                    readAt: '2018-08-12 00:00:00'
                },
                {
                    id: 4,
                    title: 'Birthday Reminder',
                    body: 'Today is Tanjas birthday.',
                    createdAt: '29 days ago',
                    readAt: '2018-08-12 00:00:00'
                },
                {
                    id: 5,
                    title: 'Sales Bonus received',
                    body: 'You received your monthly sales bonus of 3%. This month you made $2,700 extra!',
                    createdAt: '7 hours ago',
                    readAt: null
                }
            ],
        }

    },


}