# VS Code XDebug Docker Setup (Optional)
[XDebug 3](https://xdebug.org/) is a [PHP extension](https://pecl.php.net/) that can be a useful tool in debugging PHP applications. Debuggers help provide efficient ways of finding sources of issues, inspecting variables, and monitoring program state.

The following assumes you are using VS Code as your code editor, but the idea should be similar when using other code editors.

## Instructions
There are many ways to set this up, but here we just describe one:
- In VS Code, install a VS Code extension like [PHP Debug](https://marketplace.visualstudio.com/items/?itemName=xdebug.php-debug&ssr=false) created by XDebug
- We've already provided a `.vscode/launch.json`, but feel free to add more configurations as you wish.
- (Optional) Since CraftCMS has configurable caching of various types, you may want to disable them depending on what you're trying to debug. For example, to disable GraphQL caching, in the craft service environment section of your docker compose file, you can set `ENABLE_GQL_CACHING: false` to ensure graphql queries aren't cached.
- (Optional) Click to the left of lines you'd like to stop the debugger on. This sets up breakpoints which you can view in the `Run and Debug` tab at the left.
- Once you have your docker compose services running and are ready to debug, click the `Run and Debug` tab, and click the `Run and Debug` green play button to start the debugger. `F5` should also be an alternative shortcut on most systems. As the debugger stops and the desired breakpoints, you can:
  - add PHP expressions to watch for in the `Run and Debug` tab
  - hover over variables to see their content at a given moment
  - step through by pressing the blue continue button (or `F5`) 
  - or choose any of the other options XDebug provides in the toolbar.

## Additional References
If you want to further customize XDebug to your needs, here are :
- [all XDebug 3 settings](https://xdebug.org/docs/all_settings).
- [all PHP Debug settings](https://marketplace.visualstudio.com/items/?itemName=xdebug.php-debug&ssr=false#user-content-supported-launch.json-settings%3A)