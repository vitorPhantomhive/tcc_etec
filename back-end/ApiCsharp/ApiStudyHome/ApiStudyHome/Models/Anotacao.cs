using System.ComponentModel.DataAnnotations.Schema;

namespace ApiStudyHome.Models
{
    [Table("anotacao")]
    public class Anotacao
    {

        public int Id { get; set; }
        public string Nome { get; set; }
        public string Descricao { get; set; }
        public DateTime DataNota { get; set; }
        public int IdUsuario { get; set; }
        public string TipoUsuario { get; set; }


    }
}
