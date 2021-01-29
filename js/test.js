var app = new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue!'
    }
})

var app2 = new Vue({
    el: '#app-2',
    data: {
        message: '이 페이지는 ' + new Date() + ' 에 로드 되었습니다'
    }
})

var app3 = new Vue({
    el: '#app-3',
    data: {
        seen: true
    }
})

var app4 = new Vue({
    el: '#app-4',
    data: {
        todos:[
            { text: 'JavaScript 배우기' },
            { text: 'Vue 배우기' },
            { text: '무언가 멋진 것을 만들기' },
            { text: '다른 사람들에게 보여주기' }
        ]
    }
})

var app5 = new Vue({
    el: '#app-5',
    data: {
        message: 'No lem on, no mel on!'
    },
    methods: {
        reverseMessage: function () {
            this.message = this.message.split('').reverse().join('')
        }
    }
})

var app6 = new Vue({
    el: '#app-6',
    data: {
        message: '안녕하세요 Vue!'
    }
})

Vue.component('todo-item', {
    props: ['todo'],
    template: '<li>{{ todo.text }}</li>'
})
  
var app7 = new Vue({
    el: '#app-7',
    data: {
        groceryList: [
            { id: 0, text: 'Vegetables' },
            { id: 1, text: 'Cheese' },
            { id: 2, text: 'Whatever else humans are supposed to eat' }
        ]
    }
})

Vue.component('todo-item', {
                                template: '\
                                <li>\
                                    {{ title }}\
                                    <button v-on:click="$emit(\'remove\')">Remove</button>\
                                </li>\
                                ',
                                props: ['title']
                            })  
    new Vue({
        el: '#todo-list-example',
        data: {
        newTodoText: '',
        todos: [
            {
            id: 1,
            title: 'Vue.js 공부하기',
            },
            {
            id: 2,
            title: '기존에 만들었던 게시판 서비스 Vue.js로 구현 하기',
            },
            {
            id: 3,
            title: 'Git 알아보기'
            }
        ],
        nextTodoId: 4
        },
        methods: {
            addNewTodo: function () {
                this.todos.push({
                id: this.nextTodoId++,
                title: this.newTodoText
                })
                this.newTodoText = ''
            }
        }
})

Vue.component('button-counter', {
    template: '<button v-on:click="incrementCounter">{{ counter }}</button>',
    data: function () {
    return {
        counter: 0
    }
    },
    methods: {
    incrementCounter: function () {
        this.counter += 1
        this.$emit('increment')
    }
    },
})

new Vue({
    el: '#counter-event-example',
    data: {
    total: 0
    },
    methods: {
    incrementTotal: function () {
        this.total += 1
    }
    }
})