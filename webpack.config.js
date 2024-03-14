const path = require('path');

module.exports = {
  entry: './script.js', // Update this path to where your JavaScript file is located
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'bundle.js',
  },
  mode: 'production',
};
