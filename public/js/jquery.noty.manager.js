;
(function ($) {

	$.NotyManager = function (el, options) {

		var defaults = {
			bubble   : {
				top     : 10,
				left    : -2,
				showZero: false
			},
			max      : 20,
			container: $('<div />'),
			wrapper  : '<div/>',
			emptyHTML: '<div class="no-notification">There is no notification in here</div>',
			callback : {
				onOpen : function () {
				},
				onClose: function () {
				}
			},
			useNoty  : false,
			noty     : {
				layout   : 'bottomRight',
				timeout  : false,
				closeWith: ['button']
			}
		};

		var notificationDefaults = {
			useNoty : true,
			increase: true
		};

		var plugin = this;

		plugin.settings = {};

		var init = function () {
			plugin.settings = $.extend({}, defaults, options);
			plugin.$el = el;
			plugin.count = 0;

			build();
		};

		var build = function () {
			plugin.$bubble = $("<span class='noty-manager-bubble'>0</span>");

			if (isNaN(plugin.settings.bubble.top))
				plugin.settings.bubble.top = -8;

			if (isNaN(plugin.settings.bubble.left))
				plugin.settings.bubble.left = 2;

			plugin.$bubble.css({
				marginLeft: plugin.settings.bubble.left,
				top       : plugin.settings.bubble.top
			});

			plugin.$bubble.on('notymanager-flash', function () {
				plugin.$bubble.css({opacity: 0}).css({top: plugin.settings.bubble.top - 10}).animate({top: plugin.settings.bubble.top, opacity: 1})
			});

			plugin.$el.css('position', 'relative');
			plugin.$el.append(plugin.$bubble);

			var emptyHTML = $(plugin.settings.emptyHTML);
			emptyHTML.addClass('notymanager-empty-html');
			plugin.settings.container.prepend(emptyHTML);

			bindEvents();
		};

		var bindEvents = function () {
			plugin.$el.on('click', function (e) {
				plugin.$el.toggleClass('notymanager-opened');

				if (plugin.$el.hasClass('notymanager-opened'))
					showNotifications();
				else
					closeNotifications();

				e.preventDefault();
			});
		};

		var showNotifications = function () {
			if (plugin.settings.callback.onOpen)
				plugin.settings.callback.onOpen.call(plugin);
		};

		var closeNotifications = function () {
			if (plugin.settings.callback.onClose)
				plugin.settings.callback.onClose.call(plugin);
		};

		var push = function (type, html, options) {
			options = $.extend({}, notificationDefaults, options);
			if (typeof noty == 'function' && plugin.settings.useNoty && options.useNoty) {
				options = options || {};
				options.type = type;
				options.text = html;
				options = $.extend({}, options, plugin.settings.noty);
				noty(options);
			}

			if (options.increase)
				plugin.increase(1);

			var listItem = $('<div class="noty-manager-list-item noty-manager-list-item-' + type + '"/>').html(html);
			var wrapper = $(plugin.settings.wrapper).hide();
			wrapper.append(listItem);
			plugin.settings.container.prepend(wrapper);
			$(plugin.settings.container).find('.notymanager-empty-html').remove();
			wrapper.fadeIn();
		};

		plugin.increase = function (incrCount) {
			incrCount = isNaN(incrCount) ? 1 : incrCount;

			var count = parseInt(plugin.$bubble.text());
			count += incrCount;
			count = count > plugin.settings.max ? plugin.settings.max + '+' : count;
			count = count < 1 ? 0 : count;

			plugin.$bubble.text(count).trigger('notymanager-flash');

			if (!plugin.settings.bubble.showZero)
				plugin.$bubble.css({opacity: 0});

			return plugin;
		};

		plugin.decrease = function (decrementCount) {
			decrementCount = isNaN(decrementCount) ? 1 : decrementCount;
			plugin.increase(parseInt('-' + decrementCount));
			return plugin;
		};

		plugin.setCount = function (totalCount) {
			totalCount = totalCount < 1 ? 0 : totalCount;
			totalCount = totalCount > plugin.settings.max ? plugin.settings.max + '+' : totalCount;
			plugin.$bubble.text(totalCount).trigger('notymanager-flash');

			if (!plugin.settings.bubble.showZero)
				plugin.$bubble.css({opacity: 0});

			return plugin;
		};

		plugin.getNotificationCount = function () {
			return $(plugin.settings.container).children().length;
		};

		plugin.getBubbleCount = function () {
			return plugin.$bubble.text();
		};

		plugin.clearNotifications = function () {
			$(plugin.settings.container).empty();
			var emptyHTML = $(plugin.settings.emptyHTML);
			emptyHTML.addClass('notymanager-empty-html');
			plugin.settings.container.prepend(emptyHTML);
			return plugin;
		};

		plugin.alert = function (html, options) {
			push('alert', html, options);
			return plugin;
		};

		plugin.info = function (html, options) {
			push('information', html, options);
			return plugin;
		};

		plugin.warning = function (html, options) {
			push('warning', html, options);
			return plugin;
		};

		plugin.error = function (html, options) {
			push('error', html, options);
			return plugin;
		};

		plugin.notification = function (options) {
			push(options.type, options.html, options);
			return plugin;
		};

		init();
	}

})(jQuery);