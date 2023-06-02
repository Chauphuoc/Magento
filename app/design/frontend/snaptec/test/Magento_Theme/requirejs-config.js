var config = {
    map:{
        '*':{
            'owlcarousel': 'js/owl.carousel.min',
            'myfile': 'js/myfile',
            'bundlejs': 'js/bootstrap.bundle',
            'bootstrapmin': 'js/bootstrap.min.js'

        }
    },
   
    shim: {
        'owlcarousel': {
            deps: ['jquery']
        },
        'myfile': {
            deps: ['jquery']
        },
        'bundlejs': {
            deps: ['jquery']
        },
        'bootstrapmin' : {
            deps: ['jquery']
        }
    }
};

// var config = {
//     map: {
//         '*': {
//             myscript: 'js/myfile'
//         }
//     },
//     paths: {
//         'owlcarousel': 'js/owl.carousel'
//     },
//     shim: {
//         'owlcarousel': {
//             deps: ['jquery']
//         }
//     }
// };