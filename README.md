<p align=center><img width=100 src="https://raw.githubusercontent.com/DuRoom/forum-widgets-core/master/icon.svg" alt="icon"></p>
<h1 align=center>Forum Widgets</h1>
</p><p align=center>
<a href="http://duroom.js.org">DuRoom</a> Core Extension for Managing Forum Widgets.
  <br>
<img src="https://user-images.githubusercontent.com/20267363/127786249-4f17bb07-9dfb-4066-8d91-6c92b61358cd.gif" alt="animated_screenshot">
  <br>
<img width=400 src="https://user-images.githubusercontent.com/20267363/127903214-a96f08ba-1a71-42b0-bc17-5b2c65a68859.png" alt="forum screenshot">
</p>

## Installation

Remember that this is just a forum widgets editor, it doesn't actually come with any widgets.

Install with composer:

```sh
composer require duroom/forum-widgets-core:"*"
```

## Updating

```sh
composer update duroom/forum-widgets-core:"*"
php duroom migrate
php duroom cache:clear
```

## Extend
Extension developers wanting to create widgets with this small framework, the following explains how you can register a new widget, for now you should only register one widget per extension.

1. Require this extension in your extension's `composer.json`:
```json
"require": {
  "duroom/core": "^1.2",
  "duroom/forum-widgets-core": "^0.1.7"
},
```

2. Create your widget's component in `common/components` by extending the base `Widget` component provided with this package.
```jsx
import Widget from 'duroom/extensions/duroom-forum-widgets-core/common/components/Widget';

export default class MyWidget extends Widget {
  className() {
    // Custom class name.
    // You can also use the class "DuRoomWidgets-Widget--flat" for a flat widget (not contained in a block).
    // Please avoid strong custom styling so that it looks consistent in other themes.
    return 'MyWidget';
  }

  icon() {
    // Widget icon.
    return 'fas fa-cirlce';
  }

  title() {
    // Widget title.
    // Can return empty for a titleless widget.
    return app.translator.trans('duroom-online-users-widget.forum.widget.title');
  }

  content() {
    return (
      <div className="DuRoom-OnlineUsersWidget-users">
        // ...
      </div>
    );
  }
}
```

3. Register your widget in the admin and forum frontends:
* Create a new `registerWidget.js` file in `common`:
```js
import Widgets from 'duroom/extensions/duroom-forum-widgets-core/common/extend/Widgets';

import MyWidget from './components/MyWidget';

export default function(app) {
  (new Widgets).add({
    key: 'onlineUsers',
    component: MyWidget,
    
    // Can be a callback that returns a boolean value.
    // example: () => app.forum.attribute('myCustomExtension.mySetting')
    isDisabled: false,
    
    // Is this a one time use widget ? leave true if you don't know.
    isUnique: true,
    
    // The following values are default values that can be changed by the admin.
    placement: 'end',
    position: 1,
  }).extend(app, 'my-extension-id');
};
```
* Register the widget in both frontends `admin/index.js` & `forum/index.js`:
```js
import registerWidget from '../common/registerWidget';

app.initializers.add('my-extension-id', () => {
  registerWidget(app);
});
```

4. If you are using typescript, you can add the typings of this package by adding this to the `paths` key in your `tsconfig.json` file:
```json
"duroom/extensions/duroom-forum-widgets-core/*": ["../vendor/duroom/forum-widgets-core/js/dist-typings/*"]
```

You can also checkout other example widgets in the DuRoom github org.
