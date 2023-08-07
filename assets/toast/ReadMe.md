# Go to link: https://ireade.github.io/Toast.js/

# Options
* options.message (required) - The message to display in the toast
* options.type - The style of message. Can be default, success, warning, or danger. A class will be added to the Toast element for styling.
* options.customButtons - An array of objects for each custom button to add. Each object contains a text for the label of the button, and an onClick, which is a function to execute when the button is clicked.

Examples

- The only required option you need to pass is the message that is displayed in the toast. This example below is the Toast that comes up when you first visit this page

# Toast Style

***************
new Toast({
  message: 'This is a danger message. You can use this for errors etc',
  type: 'danger'
});
**************

# Custom Button Functions

**************
new Toast({
  message: 'This is an example with custom buttons',
  type: 'success',
  customButtons: [
    {
      text: 'Refresh the page',
      onClick: function() {
        window.location.reload();
      }
    },
    {
      text: 'Follow @ireaderinokun',
      onClick: function() {
        window.open('https://twitter.com/ireaderinokun');
      }
    }
  ]
});
**************