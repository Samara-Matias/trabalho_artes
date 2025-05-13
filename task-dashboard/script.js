// Dados de exemplo
const taskLists = [
  {
    id: 1,
    title: "Trabalho",
    tasks: [
      { id: 1, text: "Finalizar relatório", completed: true },
      { id: 2, text: "Reunião com cliente", completed: false },
      { id: 3, text: "Preparar apresentação", completed: false },
    ],
  },
  {
    id: 2,
    title: "Pessoal",
    tasks: [
      { id: 4, text: "Comprar mantimentos", completed: true },
      { id: 5, text: "Academia", completed: true },
      { id: 6, text: "Ler livro", completed: false },
    ],
  },
  {
    id: 3,
    title: "Projetos",
    tasks: [
      { id: 7, text: "Aprender React", completed: false },
      { id: 8, text: "Desenvolver aplicativo", completed: false },
      { id: 9, text: "Estudar Next.js", completed: true },
    ],
  },
]

// Elementos DOM
const sidebar = document.getElementById("sidebar")
const sidebarToggle = document.getElementById("sidebar-toggle")
const mainContent = document.querySelector(".main-content")
const taskListsContainer = document.getElementById("task-lists")
const totalTasksElement = document.getElementById("total-tasks")
const completedTasksElement = document.getElementById("completed-tasks")
const completionPercentageElement = document.getElementById("completion-percentage")
const overallProgressElement = document.getElementById("overall-progress")

// Estado da aplicação
let lists = [...taskLists]

// Funções de utilidade
function calculateStats() {
  const totalTasks = lists.reduce((acc, list) => acc + list.tasks.length, 0)
  const completedTasks = lists.reduce((acc, list) => acc + list.tasks.filter((task) => task.completed).length, 0)
  const completionPercentage = totalTasks > 0 ? Math.round((completedTasks / totalTasks) * 100) : 0

  return { totalTasks, completedTasks, completionPercentage }
}

function updateStats() {
  const { totalTasks, completedTasks, completionPercentage } = calculateStats()

  totalTasksElement.textContent = totalTasks
  completedTasksElement.textContent = completedTasks
  completionPercentageElement.textContent = `${completionPercentage}%`
  overallProgressElement.style.width = `${completionPercentage}%`
}

function toggleTaskCompletion(listId, taskId) {
  lists = lists.map((list) => {
    if (list.id === listId) {
      return {
        ...list,
        tasks: list.tasks.map((task) => {
          if (task.id === taskId) {
            return { ...task, completed: !task.completed }
          }
          return task
        }),
      }
    }
    return list
  })

  renderTaskLists()
  updateStats()
}

function removeTask(listId, taskId) {
  lists = lists.map((list) => {
    if (list.id === listId) {
      return {
        ...list,
        tasks: list.tasks.filter((task) => task.id !== taskId),
      }
    }
    return list
  })

  renderTaskLists()
  updateStats()
}

function toggleTaskList(listId) {
  const contentElement = document.querySelector(`.task-list-content-${listId}`)
  const iconElement = document.querySelector(`.task-list-icon-${listId}`)

  if (contentElement.classList.contains("open")) {
    contentElement.classList.remove("open")
    iconElement.classList.remove("open")
  } else {
    contentElement.classList.add("open")
    iconElement.classList.add("open")
  }
}

// Renderização
function renderTaskLists() {
  taskListsContainer.innerHTML = ""

  lists.forEach((list) => {
    const completedCount = list.tasks.filter((task) => task.completed).length
    const totalCount = list.tasks.length
    const progressPercentage = totalCount > 0 ? (completedCount / totalCount) * 100 : 0

    const listElement = document.createElement("div")
    listElement.className = "card task-list-card"

    listElement.innerHTML = `
      <div class="task-list-header" onclick="toggleTaskList(${list.id})">
        <div class="task-list-title-section">
          <i class="fa-solid fa-chevron-down rotate-icon task-list-icon-${list.id}"></i>
          <h3 class="task-list-title">${list.title}</h3>
          <span class="badge">${completedCount}/${totalCount}</span>
        </div>
        <div class="task-list-actions">
          <button class="btn btn-outline">
            <i class="fa-solid fa-plus-circle"></i>
            Adicionar Tarefa
          </button>
        </div>
      </div>
      <div class="task-list-progress">
        <div class="progress-container">
          <div class="progress-bar" style="width: ${progressPercentage}%"></div>
        </div>
      </div>
      <div class="task-list-content task-list-content-${list.id}">
        <ul class="task-items">
          ${list.tasks
            .map(
              (task) => `
            <li class="task-item ${task.completed ? "task-completed" : ""}">
              <div class="task-item-left">
                <input type="checkbox" class="task-checkbox" 
                  ${task.completed ? "checked" : ""} 
                  onchange="toggleTaskCompletion(${list.id}, ${task.id})">
                <span class="task-text">${task.text}</span>
              </div>
              <button class="task-delete" onclick="removeTask(${list.id}, ${task.id})">
                <i class="fa-solid fa-trash"></i>
              </button>
            </li>
          `,
            )
            .join("")}
          ${list.tasks.length === 0 ? '<li class="empty-list">Nenhuma tarefa nesta lista</li>' : ""}
        </ul>
      </div>
    `

    taskListsContainer.appendChild(listElement)
  })
}

// Event Listeners
sidebarToggle.addEventListener("click", () => {
  if (window.innerWidth <= 768) {
    sidebar.classList.toggle("mobile-open")
  } else {
    sidebar.classList.toggle("collapsed")
    mainContent.classList.toggle("expanded")
  }
})

// Expor funções para o HTML
window.toggleTaskCompletion = toggleTaskCompletion
window.removeTask = removeTask
window.toggleTaskList = toggleTaskList

// Inicialização
function init() {
  renderTaskLists()
  updateStats()

  // Verificar tamanho da tela para ajustar o sidebar
  if (window.innerWidth <= 768) {
    sidebar.classList.remove("collapsed")
    mainContent.classList.remove("expanded")
  }
}

// Iniciar a aplicação quando o DOM estiver carregado
document.addEventListener("DOMContentLoaded", init)

// Ajustar layout quando a janela for redimensionada
window.addEventListener("resize", () => {
  if (window.innerWidth <= 768) {
    sidebar.classList.remove("collapsed")
    sidebar.classList.remove("mobile-open")
    mainContent.classList.remove("expanded")
  }
})
