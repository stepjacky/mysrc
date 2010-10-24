/**
 * Message
 * 
 * Methods for growl-style messages
 * 
 * @author Dom Hastings
 */
var Message = {
  /**
   * options
   * 
   * @var Object The options for the script
   */
  options: {
    'appendTo': 'body', // jQuery selector of element to append messages to
    'autohide': 5,  // autohide delay in seconds, or 0 to disable autohide
    'interval': 500,  // interval between actions, in ms
    'messageClass': 'message',  // className for messages
    'messageClassActive': 'message-active',  // className for messages
    'messageContainerClass': 'messageContainer',  // className for message container
    'messageWrapperClass': 'message-wrapper',  // className for message container
    'messageTextClass': 'message-text',  // className for message text
    'messageTitleClass': 'message-title'  // className for message titles
  },
  
  /**
   * queue
   * 
   * @var Array The message data
   */
  queue: [],
  
  /**
   * container
   * 
   * @var Object The DOM node of the messages container
   */
  container: null,
  
  /**
   * init
   * 
   * Initialisation function
   * 
   * @author Dom Hastings
   * @param Object options The options to be merged with the global options
   * @return void
   */
  init: function(options) {
    $.extend(this.options, options || {});
    
    if (this.options.autohide) {
      this.options.autohide *= 1000;
    }
    
    $(this.options.appendTo)
    .append(
      $('<div id="__messageQueue__container"></div>')
      .addClass(this.options.messageContainerClass)
    );
    
    this.container = $('div#__messageQueue__container');
    
    if ('setInterval' in window) {
      window.setInterval(function() {
        Message.check();
      }, this.options.interval);

    } else {
      window.setTimeout(function() {
        Message.check(true);
      }, this.options.interval);
    }
		
		// prevent text selection in ie
    $('div#__messageQueue__container *').live('selectstart', function() {
      return false;
    });
    
    // prevent text selection in all others...
    $('div#__messageQueue__container *').live('mousedown', function() {
      $(this).css('MozUserSelect', 'none');

      return false;
    });
  },
  
  /**
   * check
   * 
   * Checks and processess the queue
   * 
   * @author Dom Hastings
   * @param Boolean timeout Whether to set a timeout again
   * @return void
   */
  check: function(timeout) {
    var now = new Date().getTime();
    
    for (var i = 0; i < this.queue.length; i++) {
      var item = this.queue[i];
      
      if (item.unread) {
        item.unread = false;
        
        this.show(item.unique);

      } else {
        if (!item.active && !item.sticky && this.options.autohide && ((!item.autohide && item.time < (now - this.options.autohide)) || (item.autohide && item.time < (now - item.autohide)))) {
          this.hide(item.unique);
        }
      }
    }
    
    if (timeout) {
      window.setTimeout(function() {
        Message.check(true);
      }, this.options.interval);
    }
  },
  
  /**
   * add
   * 
   * Adds a new message to the queue
   * 
   * @author Dom Hastings
   * @param String text The message body
   * @param String title The message title
   * @param String style The message style
   * @return Number The result from Array.push
   */
  add: function(text, title, options) {
    if (!title) {
      title = text.substr(0, 20);
      
      if (text.length > 20) {
        title += '...';
      }
    }
    
    if (!options) {
      options = {
        'style': '',
        'callback': false,
        'autohide': false
      };
      
    } else if (typeof options == 'string') {
      options = {
        'style': options,
        'callback': false,
        'autohide': false
      };
      
    } else if (typeof options == 'function') {
      options = {
        'style': '',
        'callback': options,
        'sticky': true,
        'autohide': false
      };

    } else if (typeof options == 'number') {
      options = {
        'style': '',
        'callback': false,
        'autohide': options
      };
      
    } else if (typeof options == 'object') {
      if (options.callback) {
        options.sticky = true;
      }
    }
    
    var now = new Date().getTime();
    
    return this.queue.push($.extend(options, {
      'time': now,
      'unique': now + '_' + (Math.floor(Math.random() * 90000) + 10000),
      'text': text,
      'title': title,
      'unread': true,
      'active': false,
      'sticky': (options.sticky || options.style.match(/\bsticky\b/i) ? true : false)
    }));
  },
  
  /**
   * remove
   * 
   * Removes the message with the specified unique identifier from the global queue
   * 
   * @author Dom Hastings
   * @param String unique The unique identifier
   * @return Boolean true
   */
  remove: function(unique) {
    for (var i = this.queue.length - 1; i >= 0; i--) {
      if (this.queue[i].unique == unique) {
        this.queue.splice(i, 1);
      }
    }
    
    return true;
  },
  
  /**
   * get
   * 
   * Returns the message with the specified unique identifier from the global queue
   * 
   * @author Dom Hastings
   * @param String unique The unique identifier
   * @return Object The specified message
   */
  get: function(unique) {
    for (var i = this.queue.length - 1; i >= 0; i--) {
      if (this.queue[i].unique == unique) {
        return this.queue[i];
      }
    }
    
    return false;
  },
  
  /**
   * show
   * 
   * Show the message with the specified unique identifier
   * 
   * @author Dom Hastings
   * @param String unique The unique identifier
   * @return void
   */
  show: function(unique) {
    var item = this.get(unique);
    
    $(this.container)
    .append(
      $('<div id="__messageId_' + item.unique + '"></div>')
      .addClass(this.options.messageClass)
      .append(
        $('<div></div>')
        .addClass(this.options.messageWrapperClass)
        .append(
          $('<div></div>')
          .addClass(item.style)
          .append(
            $('<h1></h1>')
            .addClass(this.options.messageTitleClass)
            .html(item.title)
          )
          .append(
            $('<p></p>')
            .addClass(this.options.messageTextClass)
            .html(item.text)
          )
        )
        .data('unique', item.unique)
        .click(function() {
          Message.hide($(this).data('unique'));
        })
        .mouseenter(function() {
          Message.active($(this).data('unique'));
        })
        .mouseleave(function() {
          Message.inactive($(this).data('unique'));
        })
      )
      .css({
        'opacity': 0
      })
      .animate({
        'opacity': 1
      }, 300)
    );
  },
  
  /**
   * hide
   * 
   * Hides the message with the specified unique identifier
   * 
   * @author Dom Hastings
   * @param String unique The unique identifier
   * @return void
   */
  hide: function(unique) {
    var item = this.get(unique);
    
    if (item.callback) {
      item.callback();
    }
    
    this.remove(unique);
    
    $('div#__messageId_' + unique)
    .animate({
      'height': '0px',
      'opacity': '0',
      'margin-bottom': '0px'
    }, 300, 'linear', function() {
      $(this).remove();
    });
  },
  
  /**
   * active
   * 
   * Sets the message with the specified unique identifier as active
   * 
   * @author Dom Hastings
   * @param String unique The unique identifier
   * @return void
   */
  active: function(unique) {
    var item = this.get(unique);
    
    $('div#__messageId_' + unique).addClass(this.options.messageClassActive);
    
    item.active = true;
  },
  
  /**
   * inactive
   * 
   * Sets the message with the specified unique identifier as inactive
   * 
   * @author Dom Hastings
   * @param String unique The unique identifier
   * @return void
   */
  inactive: function(unique) {
    var item = this.get(unique);
    
    $('div#__messageId_' + unique).removeClass(this.options.messageClassActive);
    
    item.active = false;
  }
}
