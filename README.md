# Secure_Download_Folder
Function to provide a file downloads folder and rename it daily to avoid hotlinking

Assumptions

1.  Folder to search/rename is prefixed as "az-" and is in the root directory of the webserver.
2.  Folder containing download files is within the "az-" folder is named "downloadfiles"
3.  Index page is within a iframe or other conscript and is not accessed directly.
    There is a header check at the bottom of the index page to redirect to site root.
