using ApiStudyHome.Context;
using ApiStudyHome.Models;
using Microsoft.AspNetCore.Mvc;

namespace ApiStudyHome.Controllers
{
    [ApiController]
    [Route("[controller]")]

    public class ArquivosEntreguesController : Controller
    {
        private readonly AppDbContext _context;
        public ArquivosEntreguesController(AppDbContext context)
        {
            _context = context;
        }
        // ver como faz para pegar aquivos do banco de dados e retonar como pdf ou coisa do tipo
        //adicionar lógica de só poder pegar o arquivo que lhe de direito, e não todos
        [HttpGet]
        public ActionResult<IEnumerable<ArquivoEntregue>> Get()
        {
            var arquivo = _context.ArquivoEntregues.ToArray();
            if(arquivo == null)
            {
                return NotFound();
            }

         return arquivo;
        }

    }
}
