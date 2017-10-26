
<!--
Copyright (c) 2016 by CodyHouse (http://codepen.io/codyhouse/pen/pIrbg)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
-->
<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
  <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
    
    <ul class="cd-switcher" style="list-style: none; margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline;">
      <li><a href="#0">Sign in</a></li>
      <li><a href="#0">New account</a></li>
    </ul>

    <div id="cd-login"> <!-- log in form -->



      <form id = "cd-form-login" class="cd-form">

        <p class="fieldset">
          <label class="image-replace cd-email" for="signin-email"></label>
          <input class="full-width has-padding has-border" id="signin-email" type="email" placeholder="E-mail" required="">
        </p>

        <p class="fieldset">
          <label class="image-replace cd-password" for="signin-password">Password</label>
          <input class="full-width has-padding has-border" id="signin-password" type="password"  placeholder="Password" required="">




        </p>

        <p class="cd-login-warning" style="display:none">Incorrect e-mail and/or password.</p>


        <p class="fieldset">
          <input class="full-width" type="submit" value="Login">
        </p>
      </form>

      <!-- <a href="#0" class="cd-close-form">Close</a> -->
    </div> <!-- cd-login -->

    <div id="cd-signup"> <!-- sign up form -->
      <form id="cd-form-signup" class="cd-form">
        <p class="fieldset">
          <label class="image-replace cd-username" for="signup-firstname">First name</label>
          <input class="full-width has-padding has-border" id="signup-firstname" type="text" placeholder="First name" required="">
        </p>

        <p class="fieldset">
          <label class="image-replace cd-username" for="signup-lastname">Last name</label>
          <input class="full-width has-padding has-border" id="signup-lastname" type="text" placeholder="Last name" required="">
        </p>

        <p class="fieldset">
          <label class="image-replace cd-email" for="signup-email">E-mail</label>
          <input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail" required="">
        </p>

        <p class="fieldset">
          <label class="image-replace cd-email" for="signup-email-confirm">Re-Enter E-mail</label>
          <input class="full-width has-padding has-border" id="signup-email-confirm" type="email" placeholder="Re-Enter E-mail To Confirm" required="">
        </p>

        <p class="cd-signup-warning-email-mismatch" style="display:none">E-mails do not match.</p>
        <p class="cd-signup-warning-email-taken" style="display:none">That e-mail is already in use.</p>

        <p class="fieldset">
          <label class="image-replace cd-password" for="signup-password">Password</label>
          <input class="full-width has-padding has-border" id="signup-password" type="password"  placeholder="Password" required="">
        </p>

        <p class="fieldset">
          <label class="image-replace cd-password" for="signup-password-confirm">Re-Enter Password</label>
          <input class="full-width has-padding has-border" id="signup-password-confirm" type="password"  placeholder="Re-Enter Password To Confirm" required="">









        </p>

        <p class="cd-signup-warning-password-mismatch" style="display:none">Passwords do not match.</p>


        <p class="fieldset">
          <input class="full-width has-padding" type="submit" value="Create account">
        </p>
      </form>

      <!-- <a href="#0" class="cd-close-form">Close</a> -->
    </div> <!-- cd-signup -->

    <a href="#0" class="cd-close-form">Close</a>
  </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->
