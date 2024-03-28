using Microsoft.AspNetCore.Mvc;

namespace ApiStudyHome.Controllers
{
    public class TurmaController : Controller
    {
        public IActionResult Index()
        {
            return View();
        }
    }
}
