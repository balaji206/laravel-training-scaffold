Day 11 – File Uploads, Email Notifications & Queued Jobs
========================================================

Tasks Completed
---------------

*   Implemented file upload functionality for tasks
    
*   Added attachment support during task creation
    
*   Stored uploaded files using Laravel Storage
    
*   Configured public file access using storage:link
    
*   Added attachment download/view support in task details page
    
*   Implemented task assignment system
    
*   Added user assignment dropdown in create/edit task forms
    
*   Sent email notifications when task assignment changed
    
*   Configured Mailtrap SMTP for email testing
    
*   Created TaskAssigned Mailable class
    
*   Designed markdown email template for task assignment
    
*   Implemented queued email sending using Laravel Queues
    
*   Configured database queue driver
    
*   Ran queue worker for background job processing
    
*   Added assignee relationship handling in Task model
    
*   Protected assignment actions using authorization
    

What I Learned
==============

*   How file uploads work in Laravel
    
*   How Laravel Storage system manages uploaded files
    
*   Difference between local storage and public storage
    
*   Importance of storage:link
    
*   How to send emails using Laravel Mailables
    
*   How Mailtrap helps safely test emails during development
    
*   Difference between synchronous and queued jobs
    
*   How queues improve backend performance
    
*   How background workers process queued jobs
    
*   How to use ShouldQueue
    
*   How queued jobs improve user experience
    
*   Importance of asynchronous processing in scalable systems
    

File Upload Flow
================

Browser→ Multipart Form Request→ Controller→ Storage::disk('public')→ storage/app/public→ attachment\_path saved in DB→ File accessible through public/storage

Storage Configuration
=====================

Command Used
------------

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   php artisan storage:link   `

Purpose:

*   Creates symbolic link between:
    

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   storage/app/public   `

and

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   public/storage   `

*   Allows uploaded files to be accessed publicly
    

File Upload Implementation
==========================

Form Update
-----------

Added:

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   enctype="multipart/form-data"   `

Reason:

*   Allows forms to send files properly
    

File Input Added
----------------

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`  `

File Storage Logic
------------------

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   $path = $request->file('attachment')    ->store('attachments', 'public');   `

Database Changes
================

Added column:

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   attachment_path   `

Purpose:

*   Stores uploaded file path
    

Example:

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   attachments/example.pdf   `

Attachment Display
==================

Used:

Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   []({{ asset('storage/' . $task->attachment_path) }})   `

[Purpose:]({{ asset('storage/' . $task->attachment_path) }})

*   [Allows users to download/view uploaded files]({{ asset('storage/' . $task->attachment_path) }})
    

[Mailtrap Configuration]({{ asset('storage/' . $task->attachment_path) }})
==========================================================================

[Configured SMTP credentials inside:]({{ asset('storage/' . $task->attachment_path) }})

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   .env   `]({{ asset('storage/' . $task->attachment_path) }})

[Example:]({{ asset('storage/' . $task->attachment_path) }})

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   MAIL_MAILER=smtpMAIL_HOST=sandbox.smtp.mailtrap.ioMAIL_PORT=2525MAIL_USERNAME=xxxxxMAIL_PASSWORD=xxxxxMAIL_ENCRYPTION=tls   `]({{ asset('storage/' . $task->attachment_path) }})

[Task Assignment Email]({{ asset('storage/' . $task->attachment_path) }})
=========================================================================

[Mailable Created]({{ asset('storage/' . $task->attachment_path) }})
--------------------------------------------------------------------

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   php artisan make:mail TaskAssigned --markdown=emails.task-assigned   `]({{ asset('storage/' . $task->attachment_path) }})

[Email Trigger Logic]({{ asset('storage/' . $task->attachment_path) }})
=======================================================================

[Email sent when:]({{ asset('storage/' . $task->attachment_path) }})

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   assigned_to_id changes   `]({{ asset('storage/' . $task->attachment_path) }})

[Implemented inside:]({{ asset('storage/' . $task->attachment_path) }})

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   TaskController@update   `]({{ asset('storage/' . $task->attachment_path) }})

[Queue Implementation]({{ asset('storage/' . $task->attachment_path) }})
========================================================================

[Queue Driver]({{ asset('storage/' . $task->attachment_path) }})
----------------------------------------------------------------

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   QUEUE_CONNECTION=database   `]({{ asset('storage/' . $task->attachment_path) }})

[Queue Table Creation]({{ asset('storage/' . $task->attachment_path) }})
========================================================================

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   php artisan queue:tablephp artisan migrate   `]({{ asset('storage/' . $task->attachment_path) }})

[Queue Worker]({{ asset('storage/' . $task->attachment_path) }})
================================================================

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   php artisan queue:work   `]({{ asset('storage/' . $task->attachment_path) }})

[Purpose:]({{ asset('storage/' . $task->attachment_path) }})

*   [Processes queued jobs in background]({{ asset('storage/' . $task->attachment_path) }})
    

[ShouldQueue Implementation]({{ asset('storage/' . $task->attachment_path) }})
==============================================================================

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   class TaskAssigned extends Mailable implements ShouldQueue   `]({{ asset('storage/' . $task->attachment_path) }})

[Purpose:]({{ asset('storage/' . $task->attachment_path) }})

*   [Sends emails asynchronously]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Improves request performance]({{ asset('storage/' . $task->attachment_path) }})
    

[Sync vs Queued Jobs]({{ asset('storage/' . $task->attachment_path) }})
=======================================================================

[Sync JobsQueued JobsRun immediately during requestRun in backgroundSlower response timeFaster response timeBlocks user requestNon-blockingSuitable for quick tasksSuitable for heavy tasks]({{ asset('storage/' . $task->attachment_path) }})

[When to Use Queues]({{ asset('storage/' . $task->attachment_path) }})
======================================================================

[Queues are commonly used for:]({{ asset('storage/' . $task->attachment_path) }})

*   [Emails]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Notifications]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Image processing]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Video processing]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Report generation]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Large data imports]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Background analytics]({{ asset('storage/' . $task->attachment_path) }})
    

[Relationships Used]({{ asset('storage/' . $task->attachment_path) }})
======================================================================

[Task → Assignee]({{ asset('storage/' . $task->attachment_path) }})
-------------------------------------------------------------------

[Plain textANTLR4BashCC#CSSCoffeeScriptCMakeDartDjangoDockerEJSErlangGitGoGraphQLGroovyHTMLJavaJavaScriptJSONJSXKotlinLaTeXLessLuaMakefileMarkdownMATLABMarkupObjective-CPerlPHPPowerShell.propertiesProtocol BuffersPythonRRubySass (Sass)Sass (Scss)SchemeSQLShellSwiftSVGTSXTypeScriptWebAssemblyYAMLXML`   public function assignee(){    return $this->belongsTo(User::class, 'assigned_to_id');}   `]({{ asset('storage/' . $task->attachment_path) }})

[Authorization Handling]({{ asset('storage/' . $task->attachment_path) }})
==========================================================================

*   [Only authorized users can update tasks]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Task reassignment protected through policies]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Assignment UI controlled using role checks]({{ asset('storage/' . $task->attachment_path) }})
    

[Challenges Faced]({{ asset('storage/' . $task->attachment_path) }})
====================================================================

[ProblemSolutionattachment\_path stored as NULLAdded attachment\_path to $fillableFile upload not workingAdded multipart/form-dataAttachment link not showingFixed DB storage issueUndefined $users variablePassed users from controllerassignee returned nullAdded assignment dropdown in edit formMail not appearing in MailtrapFixed queue + assignment logicQueue not processingRan php artisan queue:workMail sending confusionDebugged using direct send() before queue]({{ asset('storage/' . $task->attachment_path) }})

[Final Outcome]({{ asset('storage/' . $task->attachment_path) }})
=================================================================

*   [Task file upload system working successfully]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Attachments stored and downloadable]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Task assignment implemented successfully]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Email notifications working correctly]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Mailtrap integration completed]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Queued email processing implemented]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Background job workflow functioning properly]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Laravel Storage system integrated successfully]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Production-style asynchronous architecture achieved]({{ asset('storage/' . $task->attachment_path) }})
    
*   [Real-world backend concepts implemented successfully]({{ asset('storage/' . $task->attachment_path) }})