/*
 * lessons-embed.js — view lecture videos and slides inline on the Lessons
 * pages, without leaving the site.
 *
 *   - Videos (li.tsugi-lessons-module-video):   the YouTube link becomes a
 *     click-to-play poster that swaps in an embedded, cookie-less YouTube
 *     player in place. Nothing is requested from YouTube until the visitor
 *     clicks, and a "Watch on YouTube" fallback is kept for the rare video
 *     that disallows embedding.
 *
 *   - Slides (li.tsugi-lessons-module-slide):    PDF slide decks get a "View"
 *     toggle that expands an inline PDF viewer. .pptx decks stay plain
 *     download links (browsers cannot render PowerPoint natively).
 *
 * This is pure progressive enhancement: if the script does not run, the
 * original links keep working. Loaded via the "footers" hook in lessons.json.
 */
(function () {
    "use strict";

    // Pull an 11-char YouTube id out of any watch / youtu.be / embed URL.
    function youtubeId(url) {
        if (!url) return null;
        var m = url.match(
            /(?:youtu\.be\/|youtube(?:-nocookie)?\.com\/(?:watch\?(?:.*&)?v=|embed\/|v\/|shorts\/))([\w-]{11})/
        );
        return m ? m[1] : null;
    }

    // Visible text of an element with surrounding whitespace collapsed.
    function labelText(el) {
        return (el.textContent || "").replace(/\s+/g, " ").trim();
    }

    // ---- Videos --------------------------------------------------------

    function enhanceVideo(li) {
        if (li.getAttribute("data-py4e-embed") === "video") return;

        var link = li.querySelector('a[href*="youtu"]');
        if (!link) return;
        var id = youtubeId(link.getAttribute("href"));
        if (!id) return;

        li.setAttribute("data-py4e-embed", "video");

        var title = labelText(link) || "Video";
        var watchUrl = link.getAttribute("href");

        var wrap = document.createElement("div");
        wrap.className = "py4e-embed-video";

        var facade = document.createElement("button");
        facade.type = "button";
        facade.className = "py4e-embed-facade";
        facade.setAttribute("aria-label", "Play video: " + title);
        // YouTube thumbnail as poster; harmless if it 404s (scrim + title remain).
        facade.style.backgroundImage =
            "url('https://i.ytimg.com/vi/" + id + "/hqdefault.jpg')";
        facade.innerHTML =
            '<span class="py4e-embed-play" aria-hidden="true"></span>' +
            '<span class="py4e-embed-caption"></span>';
        facade.querySelector(".py4e-embed-caption").textContent = title;

        var fallback = document.createElement("a");
        fallback.className = "py4e-embed-fallback";
        fallback.href = watchUrl;
        fallback.target = "_blank";
        fallback.rel = "noopener noreferrer";
        fallback.textContent = "Watch on YouTube ↗";

        facade.addEventListener("click", function () {
            var frame = document.createElement("div");
            frame.className = "py4e-embed-frame";
            var iframe = document.createElement("iframe");
            iframe.src =
                "https://www.youtube-nocookie.com/embed/" +
                id +
                "?autoplay=1&rel=0";
            iframe.title = title;
            iframe.allow =
                "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
            iframe.setAttribute("allowfullscreen", "");
            frame.appendChild(iframe);
            wrap.replaceChild(frame, facade);
        });

        wrap.appendChild(facade);
        wrap.appendChild(fallback);

        // Replace the plain link with the inline player, keep the <li>.
        link.replaceWith(wrap);
    }

    // ---- Slides (PDF) --------------------------------------------------

    function enhanceSlide(li) {
        if (li.getAttribute("data-py4e-embed") === "slide") return;

        var link = li.querySelector("a[href]");
        if (!link) return;
        var href = link.getAttribute("href");
        // Only PDFs render inline; leave .pptx (and anything else) as-is.
        if (!/\.pdf(\?|#|$)/i.test(href)) return;

        li.setAttribute("data-py4e-embed", "slide");

        var title = labelText(link) || "Slides";
        var viewer = null;

        var toggle = document.createElement("button");
        toggle.type = "button";
        toggle.className = "py4e-embed-toggle";
        toggle.setAttribute("aria-expanded", "false");
        toggle.textContent = "View";

        toggle.addEventListener("click", function () {
            var open = toggle.getAttribute("aria-expanded") === "true";
            if (open) {
                if (viewer) viewer.remove();
                viewer = null;
                toggle.setAttribute("aria-expanded", "false");
                toggle.textContent = "View";
                return;
            }
            viewer = document.createElement("div");
            viewer.className = "py4e-embed-pdf";
            var iframe = document.createElement("iframe");
            iframe.src = href + "#view=FitH";
            iframe.title = title;
            iframe.loading = "lazy";
            viewer.appendChild(iframe);
            // Drop the viewer just after the list item so it spans full width.
            li.parentNode.insertBefore(viewer, li.nextSibling);
            toggle.setAttribute("aria-expanded", "true");
            toggle.textContent = "Hide";
        });

        link.insertAdjacentElement("afterend", toggle);
    }

    // ---- Boot ----------------------------------------------------------

    function run() {
        var videos = document.querySelectorAll("li.tsugi-lessons-module-video");
        for (var i = 0; i < videos.length; i++) enhanceVideo(videos[i]);

        var slides = document.querySelectorAll("li.tsugi-lessons-module-slide");
        for (var j = 0; j < slides.length; j++) enhanceSlide(slides[j]);
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", run);
    } else {
        run();
    }
})();
