document.addEventListener('DOMContentLoaded', function()
{
    SetFilters();

    /* Установка фильтров из имеющихся в атрибуте проектов data-tags */
    function SetFilters()
    {
        let projects = document.querySelectorAll('.project-card')
        let filterList = document.querySelector('.projects .tags-filter');
        let arFilterList = [];

        addTagFilter('all', filterList, arFilterList);

        projects.forEach(project => {
            let tags = project.getAttribute('data-tags');
            project.setAttribute('data-tags', tags.toLowerCase())
            let tagsList = tags.split(' ');
            tagsList.forEach(tag => addTagFilter(tag, filterList, arFilterList))
        });
    }

    function addTagFilter(tag, filterList, arFilterList)
    {
        tag = tag.toLowerCase();
        if (tag && arFilterList.indexOf(tag) === -1)
        {
            arFilterList.push(tag);

            let filter = document.createElement('button');
            filter.setAttribute('class', 'filter-btn')
            filter.setAttribute('data-filter', tag);
            filter.innerText = tag === 'all' ? 'Все' : tag;
            if (tag === 'all') filter.classList.add('active');
            filter.addEventListener('click', () => {
                document.querySelectorAll('.projects .filter-btn').forEach(
                    item => item.classList.remove('active')
                )
                filter.classList.add('active');
                ShowFilteredProjects(tag);
            })

            filterList.append(filter);
        }
    }

    function ShowFilteredProjects(filter)
    {
        filter = filter.toLowerCase();

        document.querySelectorAll('.project-card').forEach(item => {
            if (filter === 'all')
            {
                item.classList.remove('hidden');
                return;
            }

            if (!item.classList.contains('hidden'))
            {
                item.classList.add('hidden');
            }

            let tags = item.getAttribute('data-tags').split(' ');
            if (tags.indexOf(filter) !== -1)
            {
                item.classList.remove('hidden');
            }
        })
    }
});
