$(document).on('click', '.clear-search', function (e) {
    e.preventDefault();
    $(this).parents('.input-group').find('input[name=search]').val('')
})

$(document).on('click', '.btn-tabs', function (e) {
    e.preventDefault();
    var $this  = $(this);
    var target = $this.data('target');
    var title  = $this.data('title');
    $('.custom-tab-content').find('.custom-tab-pane').removeClass('is-active');
    $(target).addClass('is-active');
    $this.parents('.btn-group').find('button.dropdown-toggle').html(title);
})

var dragMoveListener = function (event) { 
    
    var target = event.target;
    var wpdz = $('.custom-tab-pane.is-active').find('.workplace-dropzone').offset();    
    target.style.left   = (event.pageX - wpdz.left) + 'px',
    target.style.top    = (event.pageY - wpdz.top) + 'px'
    // return false;
    // var target = event.target;
    // var wpdz = $('.custom-tab-pane.is-active').find('.workplace-dropzone').offset();     
    // if(event.pageX>=wpdz.left && event.pageY>=wpdz.top){
        
    //         target.style.left   = (event.pageX - wpdz.left) + 'px',
    //         target.style.top    = (event.pageY - wpdz.top) + 'px'
        
    // }
}
function x(){
    console.log('mangit')
}
window.dragMoveListener = dragMoveListener;

interact('.drag-element')  //Moving table
    .draggable({
        allowFrom: '.win-move-grip',
        manualStart : true,  
        modifiers: [
            interact.modifiers.restrict({
                restriction: "parent",
            })
        ],    
        onmove: dragMoveListener
    })
    .on('move', function (event) {
        var floor =$('.custom-tab-pane.is-active')
        var interaction = event.interaction;
        if (interaction.pointerIsDown && !interaction.interacting() && event.currentTarget.classList.contains('drag-element')) {
            var uuid=createUuid()
            var name=createTableName()
            var content =   '<div class="drag-item kt-portlet kt-portlet--solid-dark kt-portlet--height-fluid table-element" id="'+uuid+'" data-uuid="'+uuid+'" data-status="temp"  data-slug="'+uuid+'" data-new=true data-name="'+name+'" data-floor='+floor.data('slug')+'>'+
                               
                                '<div class="kt-portlet__body">'+
                                    '<div class="kt-portlet__content">'+
                                   
                                        // '<div class="win-move-grip"></div>'+

                                        '<h3>Table : <span class="table-name">'+name+'</span></h3>'+
                                        '<p>Status: <span class="table-status">Not Saved<span></p>'+
                                        '<br><br>'+
                                        '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon btn-table-edit" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Edit" data-uuid="'+uuid+'"><i class="la la-edit"></i></a>'+
                                        '<a href="#" class="btn btn-font-light btn-elevate btn-outline-hover-light btn-icon" data-container="body" data-toggle="kt-popover" data-placement="top" data-content="Delete"><i class="la la-trash"></i></a>'+
                                        '<div class="win-size-grip"></div>'+
                                        '<div class="win-move-grip"></div>'+
                                    '</div>'+
                                ' </div> '+ 
                            '</div>';

            var original = event.currentTarget;
            var clone = event.currentTarget.cloneNode(true);
            clone.className = clone.className.replace(/\bdrag-element\b/,'drag-drop-element');
            clone.innerHTML = content;
            
            $('.custom-tab-pane.is-active').find('.workplace-dropzone').append(clone);
            interaction.start({ name: 'drag' }, event.interactable, clone);
        } 
        else {
            interaction.start({ name: 'drag' }, event.interactable, event.currentTarget);
        }
    });

interact('.drag-object') //Moving Object
    .draggable({
        inertia: true,
        modifiers: [
            interact.modifiers.restrict({
                // restriction: "parent",
            }),
        ],
        autoScroll: true,
        onmove: dragMoveListener
    })
    .on('move', function (event) {
        var floor =$('.custom-tab-pane.is-active')
        var interaction = event.interaction;
        if (interaction.pointerIsDown && !interaction.interacting() && event.currentTarget.classList.contains('drag-object')) {
            var uuid=createUuid()
            var name=createObjectName()
            var content =   '<div class="obstacle-element" id="'+uuid+'" data-uuid="'+uuid+'" data-status="temp"  data-slug="'+uuid+'" data-new=true data-name="'+name+'" data-floor='+floor.data('slug')+'>'+
                                '<p>Object : <span class="object-name">'+name+'</span></p>'+
                                '<p>Status: <span class="object-status">Not Saved</span></p>'+
                                '<button type="button" class="btn btn-outline-hover-dark btn-elevate btn-icon btn-object-edit" data-uuid="'+uuid+'"><i class="la la-edit"></i></button>'+
                                '<button type="button" class="btn btn-outline-hover-dark btn-elevate btn-icon btn-object-delete"><i class="la la-trash"></i></button>'+
                                '<div class="win-size-grip"></div>'+
                            '</div>';
            var original = event.currentTarget;
            var clone = event.currentTarget.cloneNode(true);
            clone.className = clone.className.replace(/\bdrag-object\b/,'drag-drop-object');
            clone.innerHTML = content;
            //document.getElementById('workplace-dropzone').appendChild(clone);
            $('.custom-tab-pane.is-active').find('.workplace-dropzone').append(clone);
            interaction.start({ name: 'drag' }, event.interactable, clone);
        } 
        else {
            interaction.start({ name: 'drag' }, event.interactable, event.currentTarget);
        }
    });

interact('#workplace-dropzone').dropzone({overlap: 0.9});

interact('.drag-drop-element')
    .draggable({  
        allowFrom: '.win-move-grip',
        inertia: true,
        modifiers: [
            interact.modifiers.restrict({
                restriction: "parent",
            }),
        ],
        // enable autoScroll
        autoScroll: true,
        onmove: dragMoveListener
    })    
    .resizable({
        edges: {
            bottom   : '.win-size-grip',       
            right  : '.win-size-grip', 
            top  : false,     // Disable resizing from left edge.
            left  : false,
            // bottom: '.resize-s',// Resize if pointer target matches selector
            // right : handleEl    // Resize if pointer target is the given Element
          },
        // edges: { left: true, right: true, bottom: true, top: true },

        modifiers: [
            interact.modifiers.restrictEdges({
                outer: 'parent',
                endOnly: true,
            }),

            interact.modifiers.restrictSize({
                min: { width: 100, height: 50 },
            }),
        ],

        inertia: true
    })
    .on('resizemove', function (event) { 
        var target = event.target,
            x = (parseFloat(target.getAttribute('data-x')) || 0),
            y = (parseFloat(target.getAttribute('data-y')) || 0); 
            width = parseFloat(event.rect.width);
        target.style.width  = event.rect.width + 'px';
        target.style.height = event.rect.height + 'px';

        x += event.deltaRect.left;
        y += event.deltaRect.top;

        target.style.webkitTransform = target.style.transform =
            'translate(' + x + 'px,' + y + 'px)';

        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
    });

interact('.drag-drop-object')
    .draggable({
        inertia: true,
        modifiers: [
            interact.modifiers.restrict({
                restriction: "parent",
                endOnly: true,
                elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
            })
        ],
        autoScroll: true,
        onmove: dragMoveListener
    })
    .resizable({
        edges: { 
            bottom   : '.win-size-grip',       
            right  : '.win-size-grip', 
            top  : false,     // Disable resizing from left edge.
            left  : false
        },

        modifiers: [
            interact.modifiers.restrictEdges({
                outer: 'parent',
                endOnly: true,
            }),

            interact.modifiers.restrictSize({
                min: { width: 100, height: 50 },
            }),
        ],

        inertia: true
    })
    .on('resizemove', function (event) { 
        var target = event.target,
            x = (parseFloat(target.getAttribute('data-x')) || 0),
            y = (parseFloat(target.getAttribute('data-y')) || 0); 
            width = parseFloat(event.rect.width);
        target.style.width  = event.rect.width + 'px';
        target.style.height = event.rect.height + 'px';

        x += event.deltaRect.left;
        y += event.deltaRect.top;

        target.style.webkitTransform = target.style.transform =
            'translate(' + x + 'px,' + y + 'px)';

        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
    });


function createUuid(length=32) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
function createTableName(length=4) {
    var result           = 'Table ';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

function createObjectName(length=4) {
    var result           = 'Object ';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}